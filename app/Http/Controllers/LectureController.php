<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lecture\AddTopicRequest;
use App\Http\Requests\Lecture\UpdateLectureProfileRequest;
use App\Models\Lecture;
use App\Models\Semester;
use App\Models\Topic;
use App\Models\TopicType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LectureController extends Controller
{
    // Update Lecture Proflie
    public function UpdateLecture(UpdateLectureProfileRequest $request)
    {
        $saveError = null;
        $lecture = Lecture::find(Auth::id());
        $input = $request->validated();
        $lecture->fill($input);
        if ($lecture->save()) {
            Session::flash('success', 'Bạn đã cập nhật thông tin thành công');
            return redirect()->route('LectureProfile');
        }
        $request->flash();
        $saveError = 'Đã có lỗi xảy ra trong quá trình lưu';
        return view('lecture.lectureUpadateProfile', ['saveError' => $saveError]);
    }

    public function AddTopicView()
    {
        $semester = Semester::where('current', 1)->first();
        $current_date = date('d/m/Y');
        if ($current_date < date('d/m/Y', strtotime($semester->time_start_give_topic)))
            return redirect()->back()->withInput()->with('info', 'Thời gian bắt đầu nhập niên luận: ' . date('d/m/Y', strtotime($semester->time_start_give_topic)));
        if ($current_date > date('d/m/Y', strtotime($semester->time_end_give_topic)))
            return redirect()->back()->withInput()->with('info', 'Thời gian nhập niên luận đã kết thúc');


        $topic_types = TopicType::all();
        $data = [
            'semester' => $semester,
            'topic_types' => $topic_types,
        ];
        return view('lecture.addTopic', $data);
    }

    public function AddTopic(AddTopicRequest $request)
    {
        $semester_id = Semester::where('current', 1)->value('id');
        $lecture_id = Auth::id();
        $input = $request->validated();
        $topic = new Topic();
        $topic->name = $input['name'];
        $topic->number = $input['number'];
        $topic->topic_type_id = $input['topic_type_id'];
        $topic->semester_id = $semester_id;
        $topic->lecture_id = $lecture_id;
        if ($topic->save())
            return redirect()->route('lecture.addTopic')->with('success', 'Bạn đã thêm thành công niên luận');
        return redirect()->route('lecture.addTopic')->withInput()->with('error', 'Đã có lỗi trong quá trình lưu');
    }

    public function TopicList(Request $request)
    {
        $lecture_id = Auth::id();
        $current_semester = Semester::where('current', 1)->first();
        if (!$request->ajax()) {
            $semesters = Semester::all();
            $topics = Topic::where('lecture_id', $lecture_id)->where('semester_id', $current_semester->id)->paginate(10);
            $data = [
                'current_semester' => $current_semester,
                'semesters' => $semesters,
                'topics' => $topics,
            ];
            return view('lecture.topicList', $data);
        }
        if ($request->input('semester_no') == null || $request->input('semester_name') == null)
            $topics = Topic::where('lecture_id', $lecture_id)->where('semester_id', $current_semester->id)->paginate(10);
        else {

            $semester_id = Semester::where('semester_no', $request->input('semester_no'))->where('semester_name', $request->input('semester_name'))->value('id');
            $topics = Topic::where('lecture_id', $lecture_id)->where('semester_id', $semester_id)->paginate(10);
        }

        $data = [
            'current_semester' => $current_semester,
            'topics' => $topics,
        ];
        $html = view('lecture.topicList-table', $data)->render();
        return response()->json(['data' => $html]);
    }

    public function GetEditTopic(Request $request)
    {
        $topic_id = $request->query('id');
        $topic = Topic::find($topic_id);
        if ($topic) {

            if (Gate::allows('edit-topic', $topic)) {
                $semester = Semester::find($topic->semester_id);
                $topic_types = TopicType::all();

                $data = [
                    'topic' => $topic,
                    'topic_types' => $topic_types,
                    'semester' => $semester
                ];
                return view('lecture.editTopic', $data);
            }
            return back()->with('error', 'Bạn không có quyền chỉnh sửa niên luận này');
        }
        return back()->with('error', 'Không tồn tại niên luận');
    }

    public function EditTopic(AddTopicRequest $request)
    {
        $input = $request->validated();
        $topic_id = $request->query('id');
        $topic = Topic::find($topic_id);
        if (Gate::allows('edit-topic', $topic)) {

            $topic->name = $input['name'];
            $topic->number = $input['number'];
            $topic->topic_type_id = $input['topic_type_id'];

            if ($topic->save())
                return redirect()->route('lecture.topicList')->with('success', 'Bạn đã cập nhật thành công niên luận');
            return back()->with('error', 'Đã có lỗi trong quá trình lưu');
        }
        return back()->with('error', 'Bạn không có quyền chỉnh sửa niên luận này');
    }

    public function DeleteTopic(Request $request)
    {
        $id = $request->input('id');
        $topic = Topic::find($id);


        if ($request->ajax()) {
            if ($topic) {
                if ($topic->delete()) {
                    return response()->json(
                        [
                            'message' => $topic->name . ' đã được xóa thành công.'
                        ],
                        Response::HTTP_OK
                    );
                } else {
                    return response()->json(
                        [
                            'message' => 'Đã có lỗi xảy ra, không thể xóa niên luận'
                        ],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
            return response()->json(
                [
                    'message' => 'Niên luận không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
