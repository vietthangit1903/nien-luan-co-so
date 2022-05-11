<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\ProgressReportRequest;
use App\Http\Requests\Student\ReportRequest;
use App\Http\Requests\Student\UpdateStudentProfileRequest;
use App\Models\Evaluation;
use App\Models\Perform;
use App\Models\ProgressReport;
use App\Models\Report;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    // Update Student Proflie
    public function UpdateStudent(UpdateStudentProfileRequest $request)
    {
        $saveError = null;
        $student = Student::find(Auth::id());
        $input = $request->validated();
        $student->fill($input);
        if ($student->save()) {
            Session::flash('success', 'Bạn đã cập nhật thông tin thành công');
            return redirect()->route('StudentProfile');
        }
        $request->flash();
        $saveError = 'Đã có lỗi xảy ra trong quá trình lưu';
        return view('student.studentUpdateProfile', ['saveError' => $saveError]);
    }

    public function GetRegisterTopic(Request $request)
    {
        $current_semester = Semester::where('current', 1)->first();
        $current_time = time();
        if ($current_time < strtotime($current_semester->time_start_reg_topic))
            return redirect()->back()->withInput()->with('info', 'Thời gian bắt đầu đăng ký niên luận: ' . date('d/m/Y', strtotime($current_semester->time_start_reg_topic)));
        if ($current_time > strtotime($current_semester->time_end_reg_topic))
            return redirect()->back()->withInput()->with('info', 'Thời gian đăng ký niên luận đã kết thúc');

        $student = Auth::user();
        $registered_topic = Topic::join('perform', 'perform.topic_id', '=', 'topic.id')
            ->select('topic.id')
            ->where([['perform.student_id', $student->id], ['topic.semester_id', $current_semester->id]])->first();

        if ($registered_topic)
            $registered_topic_id = $registered_topic->id;
        else
            $registered_topic_id = null;

        $topics = Topic::join('lectures', 'lectures.id', '=', 'topic.lecture_id')
            ->leftJoin('perform', 'topic.id', '=', 'perform.topic_id')
            ->select('topic.*')
            ->selectRaw('COUNT(perform.student_id) as registered_number')
            ->where([
                ['lectures.subject_id', $student->subject_id],
                ['topic.semester_id', $current_semester->id]
            ])
            ->groupBy('topic.id')
            ->paginate(10);
        $data = [
            'current_semester' => $current_semester,
            'topics' => $topics,
            'registered_topic_id' => $registered_topic_id,
        ];
        if ($request->ajax()) {
            $data = [
                'topics' => $topics,
                'registered_topic_id' => $registered_topic_id,
            ];
            $html = view('student.registerTopic-table', $data)->render();

            return response()->json(['data' => $html]);
        }

        return view('student.registerTopic', $data);


        /**
         * Đang dừng ở việc hiện  đăng ký niên luận
         * Công việc cần làm:
         * - Reload ajax khi đăng ký thành công
         */
    }

    public function RegisterTopic(Request $request)
    {
        $id = $request->input('id');
        $topic = Topic::find($id);
        if ($topic) {
            $student = Auth::user();
            $current_semester = Semester::where('current', 1)->first();
            $registered_topic_id = Topic::join('perform', 'perform.topic_id', '=', 'topic.id')
                ->select('perform.topic_id')
                ->where([['perform.student_id', $student->id], ['topic.semester_id', $current_semester->id]])->first();
            if (!$registered_topic_id) {
                $registered_number = DB::table('topic')->leftJoin('perform', 'topic.id', '=', 'perform.topic_id')
                    ->selectRaw('COUNT(perform.student_id) as registered_number')
                    ->where('topic.id', $id)->value('registered_number');
                if ($topic->number > $registered_number) {
                    $perform = new Perform();
                    $perform->student_id = $student->id;
                    $perform->topic_id = $topic->id;
                    if ($perform->save()) {
                        return response()->json(
                            [
                                'message' => 'Bạn đã đăng ký thành công'
                            ],
                            Response::HTTP_OK
                        );
                    }
                    return response()->json(
                        [
                            'message' => 'Đã có lỗi xảy ra, chưa đăng ký thành công'
                        ],
                        Response::HTTP_BAD_REQUEST
                    );
                }
                return response()->json(
                    [
                        'message' => 'Đã đủ sinh viên cho niên luận'
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }
            return response()->json(
                [
                    'message' => 'Bạn không thể đăng ký 2 niên luận cùng lúc'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
        return response()->json(
            [
                'message' => 'Niên luận không tồn tại'
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    public function CancelRegisterTopic(Request $request)
    {
        $topic_id = $request->input('id');
        $student_id = Auth::id();

        $perform = Perform::where([['topic_id', $topic_id], ['student_id', $student_id]])->first();
        if ($perform) {
            if ($perform->delete()) {
                return response()->json(
                    [
                        'message' => 'Bạn đã hủy đăng ký thành công'
                    ],
                    Response::HTTP_OK
                );
            }
            return response()->json(
                [
                    'message' => 'Đã có lỗi xảy ra, chưa hủy đăng ký thành công'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
        return response()->json(
            [
                'message' => 'Đăng ký không tồn tại'
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    public function TopicList(Request $request)
    {
        $student_id = Auth::id();
        $current_semester = Semester::where('current', 1)->first();
        if (!$request->ajax()) {
            $semesters = Semester::all();
            $topics = Topic::join('perform', 'topic.id', '=', 'perform.topic_id')
                ->leftJoin('report', 'report.student_id', '=',  'perform.student_id')
                ->leftJoin('evaluation', 'report.id', '=',  'evaluation.report_id')
                ->select('topic.*', 'evaluation.id as evaluation_id')
                ->where('perform.student_id', $student_id)
                ->where('topic.semester_id', $current_semester->id)
                ->paginate(10);
            $data = [
                'current_semester' => $current_semester,
                'semesters' => $semesters,
                'topics' => $topics,
            ];
            return view('student.topicList.topicList', $data);
        }
        $semester_id = Semester::where('semester_no', $request->input('semester_no'))->where('semester_name', $request->input('semester_name'))->value('id');
        $topics = Topic::leftJoin('perform', 'topic.id', '=', 'perform.topic_id')
            ->leftJoin('report', 'report.student_id', '=',  'perform.student_id')
            ->leftJoin('evaluation', 'report.id', '=',  'evaluation.report_id')
            ->select('topic.*', 'evaluation.id as evaluation_id')
            ->where('perform.student_id', $student_id)
            ->where('topic.semester_id', $semester_id)
            ->paginate(10);


        $data = [
            'current_semester' => $current_semester,
            'topics' => $topics,
        ];
        $html = view('student.topicList.topicList-table', $data)->render();
        return response()->json(['data' => $html]);
    }

    public function GetProgressReport(Request $request)
    {
        $topic_id = $request->query('topic_id');
        $student_id = Auth::id();
        $performed = Perform::where([['topic_id', $topic_id], ['student_id', $student_id]])->first();
        if (!$request->ajax()) {
            if ($performed) {
                $progressReports = ProgressReport::where([['topic_id', $topic_id], ['student_id', $student_id]])->paginate(10);
                return view('student.progressReport.progressReport', ['progressReports' => $progressReports]);
            }
            return back()->with('error', 'Bạn không thể báo cáo tiến độ cho niên luận này');
        } else {
            if ($performed) {
                $progressReports = ProgressReport::where([['topic_id', $topic_id], ['student_id', $student_id]])->paginate(10);
                $html = view('student.progressReport.progressReport-table', ['progressReports' => $progressReports])->render();
                return response()->json(['data' => $html]);
            }
            return response()->json(
                [
                    'message' => 'Bạn không thể xem báo cáo tiến độ của niên luận này'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function SaveProgressReport(ProgressReportRequest $request)
    {
        $topic_id = $request->query('topic_id');
        $student_id = Auth::id();
        $input = $request->validated();
        $performed = Perform::where([['topic_id', $topic_id], ['student_id', $student_id]])->first();
        if ($performed) {
            $progressReport = new ProgressReport();
            $progressReport->topic_id = $topic_id;
            $progressReport->student_id = $student_id;
            $progressReport->content = $input['progress-report-content'];
            if ($progressReport->save()) {
                return back()->with('success', 'Bạn đã thêm báo cáo thành công');
            }
            return back()->withInput()->with('error', 'Đã có lỗi trong quá trình lưu');
        }
        return back()->with('error', 'Bạn không thể báo cáo tiến độ cho niên luận này');
    }

    public function DeleteProgressReport(Request $request)
    {
        $progressReportId = $request->input('id');
        $progressReport = ProgressReport::find($progressReportId);
        if ($progressReport) {
            if ($progressReport->student_id == Auth::id()) {
                if ($progressReport->delete())
                    return response()->json(
                        [
                            'message' => 'Đã xóa báo cáo tiến độ thành công'
                        ],
                        Response::HTTP_OK
                    );
            }
            return response()->json(
                [
                    'message' => 'Bạn không thể xóa báo cáo tiến độ này'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
        return response()->json(
            [
                'message' => 'Báo cáo tiến độ không tồn tại'
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    public function ShowUploadReport(Request $request)
    {
        $topic_id = $request->query('topic_id');
        $student_id = Auth::id();
        $performed = Perform::where([['topic_id', $topic_id], ['student_id', $student_id]])->first();
        if ($performed) {
            $topic = Topic::find($topic_id);
            $report = Report::where([['topic_id', $topic_id], ['student_id', $student_id]])->first();
            if ($report)
                return view('student.report.deleteReport', ['topic' => $topic, 'report' => $report]);

            return view('student.report.uploadReport', ['topic' => $topic]);
        }
        return back()->with('error', 'Bạn không thể tải báo cáo cho niên luận này');
    }

    public function UploadReport(ReportRequest $request)
    {
        $topic_id = $request->input('topic_id');

        $wordName = $request->file('wordFile')->getClientOriginalName();
        $wordPath = $request->file('wordFile')->store('Words');

        $powerPointName = $request->file('powerPointFile')->getClientOriginalName();
        $powerPointPath = $request->file('powerPointFile')->store('PowerPoints');

        $report = new Report();
        $report->topic_id = $topic_id;
        $report->student_id = Auth::id();
        $report->word_name = $wordName;
        $report->word_path = $wordPath;
        $report->power_point_name = $powerPointName;
        $report->power_point_path = $powerPointPath;
        $report->save();
        return redirect()->route('student.topicList')->with('success', 'Báo cáo đã được nộp thành công');
    }

    public function CancelReportSubmission(Request $request)
    {
        $report_id = $request->input('id');
        $report = Report::find($report_id);
        if ($report->student_id == Auth::id()) {
            if ($report->delete()) {
                Storage::delete([$report->word_path, $report->power_point_path]);
                return response()->json(['message' => 'Báo cáo chính đã được hủy nộp thành công'], Response::HTTP_OK);
            }
            return response()->json(['message' => 'Đã có lỗi xảy ra, không thể hủy nộp niên luận'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function GetEvaluation(Request $request)
    {
        $evaluation = Evaluation::find($request->query('evaluation_id'));
        $topic = Topic::find($request->query('topic_id'));
        if ($evaluation) {
            $report = Report::find($evaluation->report_id);
            if ($report->student_id != Auth::id()) {
                return back()->with('error', 'Bạn không thể xem đánh giá này');
            }
        }
        return view('student.evaluation', ['topic' => $topic, 'evaluation' => $evaluation]); 
    }
}
