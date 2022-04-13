<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Models\Academic_rank;
use App\Models\Admin\Role;
use App\Models\Admin\Subject;
use App\Models\Lecture;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class LectureController extends Controller
{
    public function ShowLectureList()
    {
        $lectures = Lecture::paginate(10);

        $data = [
            'lectures' => $lectures
        ];

        if (request()->ajax()) {
            $html = view('admin.lecture.lecture-table', ['lectures' => $lectures])->render();

            return response()->json(['data' => $html]);
        }

        return view('admin.lecture.lecture', $data);
    }

    public function ShowCreateLecture()
    {
        $academics = Academic_rank::all();
        $positions = Position::all();
        $subjects = Subject::all();

        $data = [
            'academics' => $academics,
            'positions' => $positions,
            'subjects' => $subjects
        ];

        return view('admin.lecture.createLecture', $data);
    }

    public function CreateLecture(CreateLectureRequest $request)
    {
        $saveError = null;
        $input = $request->validated();
        $lecture = new Lecture();
        $lecture->fullName = $input['fullName'];
        $lecture->email = $input['email'];
        $lecture->password = Hash::make('Abc@12345');
        $lecture->dateOfBirth = $input['dateOfBirth'];
        $lecture->subject_id = $input['subject'];
        $lecture->academic_id = $input['academic'];
        $lecture->position_id = $input['position'];
        $lecture->role_id = Role::where('name', 'Giảng viên')->first()->id;

        if ($lecture->save()) {
            Session::flash('success', 'Chúc mừng bạn đã thêm giảng viên thành công!');
            return redirect()->route('admin.showLectureList');
        }
        $saveError = 'Đã có lỗi xảy ra trong quá trình lưu';
        $request->flash();

        return view('admin.lecture.createLecture', ['saveError' => $saveError]);
    }

    public function UpdateLectureInfoView(Request $request)
    {
        $id = $request->query('id');
        $lecture = Lecture::find($id);

        if ($lecture) {
            $academics = Academic_rank::all();
            $positions = Position::all();
            $subjects = Subject::all();
            $roles = Role::all();
            $data = [
                'academics' => $academics,
                'positions' => $positions,
                'subjects' => $subjects,
                'roles' => $roles,
                'lecture' => $lecture
            ];
            return view('admin.lecture.updateLecture', $data);
        }
        Session::flash('error', 'Không có thông tin giảng viên');
        return $this->ShowLectureList();
    }

    public function UpdateLecture(UpdateLectureRequest $request)
    {
        $input = $request->validated();
        $id = $input['id'];
        $lecture = Lecture::find($id);
        $lecture->subject_id = $input['subject'];
        $lecture->academic_id = $input['academic'];
        $lecture->position_id = $input['position'];
        $lecture->role_id = $input['role'];

        if ($lecture->save()) {
            return redirect()->route('admin.showLectureList')->with('success', 'Chúc mừng bạn đã cập nhật giảng viên thành công!');
        }

        return back()->withInput();
    }

    public function DeleteLecture(Request $request)
    {
        $id = $request->input('id');        
        $lecture = Lecture::find($id);


        if ($request->ajax()) {
            if ($lecture) {
                if ($lecture->delete()) {
                    return response()->json(
                        [
                            'message' => $lecture->fullName . ' đã được xóa thành công.'
                        ],
                        Response::HTTP_OK
                    );
                } else {
                    return response()->json(
                        [
                            'message' => 'Đã có lỗi xảy ra, không thể xóa giảng viên'
                        ],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
            return response()->json(
                [
                    'message' => 'Giảng viên không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
