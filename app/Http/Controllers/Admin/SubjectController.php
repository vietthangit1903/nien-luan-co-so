<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    public function ShowSubject()
    {
        $subjects = Subject::paginate(10);

        $data = [
            'subjects' => $subjects
        ];
        if (request()->ajax()) {
            $html = view('admin.table', ['subjects' => $subjects])->render();

            return response()->json(['data' => $html]);
        }

        return view('admin.dashboard', $data);
    }

    public function AddSubject(Request $request)
    {
        $request->flash();
        $input = $request->all();
        $subject = new Subject();
        $subject->name = $input['subject_name'];

        if ($subject->Validate($input['subject_name'])) {
            if ($subject->save()) {
                Session::flash('success', 'Chúc mừng bạn đã thêm bộ môn thành công!');
                return $this->showSubject();
            } else
                $subject->errors['failed'] = 'Đã có lỗi xảy ra trong quá trình lưu';
        }

        $subjects = Subject::paginate(10);

        $data = [
            'subjects' => $subjects,
            'errors' => $subject->errors
        ];
        // dd($data);
        return view('admin.dashboard', $data);
    }

    public function ShowEditSubject(Request $request)
    {
        $id = $request->query('id');
        $editSubject = Subject::find($id);

        $subjects = Subject::paginate(10);

        $data = [
            'subjects' => $subjects,
            'editSubject' => $editSubject
        ];
        if ($editSubject)
            return view('admin.dashboard', $data);

        $data = [
            'subjects' => $subjects,
            'errors' => ['notExist' => 'Bộ môn không tồn tại']
        ];
        return view('admin.dashboard', $data);
    }

    public function EditSubject(Request $request){
        $request->flash();
        $input = $request->all();

        $id = $input['id'];
        $subject = Subject::find($id);
        $subject->name = $input['subject_name'];

        if ($subject->Validate($input['subject_name'])) {
            if ($subject->save()) {
                Session::flash('success', 'Chúc mừng bạn đã cập nhật bộ môn thành công!');
                return $this->showSubject();
            } else
                $subject->errors['failed'] = 'Đã có lỗi xảy ra trong quá trình lưu';
        }

        $subjects = Subject::paginate(15);

        $data = [
            'subjects' => $subjects,
            'errors' => $subject->errors
        ];
        return view('admin.dashboard', $data);
    }

    public function DeleteSubject(Request $request){
        $id = $request->input('id');
        $subject = Subject::find($id);

        if ($request->ajax()) {
            if ($subject) {
                if ($subject->delete()) {
                    return response()->json(
                        [
                            'message' => $subject->name . ' đã được xóa thành công.'
                        ],
                        Response::HTTP_OK
                    );
                } else {
                    return response()->json(
                        [
                            'message' => 'Đã có lỗi xảy ra, không thể xóa bộ môn'
                        ],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
            return response()->json(
                [
                    'message' => 'Bộ môn không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
