<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\UpdateStudentProfileRequest;
use App\Models\Perform;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        if($perform){
            if($perform->delete()){
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
}
