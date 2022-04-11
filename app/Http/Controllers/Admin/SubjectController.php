<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Admin\Subject;
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
            $html = view('admin.subject.subject-table', ['subjects' => $subjects])->render();

            return response()->json(['data' => $html]);
        }

        return view('admin.subject.subject', $data);
    }

    public function AddSubject(CreateSubjectRequest $request)
    {
        $saveError = null;
        $subject = new Subject();
        $subject->name = $request->validated()['name'];
        if ($subject->save()) {
            Session::flash('success', 'Chúc mừng bạn đã thêm bộ môn thành công!');
        } else {
            $saveError = 'Đã có lỗi xảy ra trong quá trình lưu';
            $request->flash();
        }

        $subjects = Subject::paginate(10);

        $data = [
            'subjects' => $subjects,
            'saveError' => $saveError
        ];
        return view('admin.subject.subject', $data);
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
            return view('admin.subject.subject', $data);

        $data = [
            'subjects' => $subjects,
            'errors' => ['notExist' => 'Bộ môn không tồn tại']
        ];
        return view('admin.subject.subject', $data);
    }

    public function EditSubject(UpdateSubjectRequest $request)
    {
        $saveError = null;
        $input = $request->validated();
        $id = $input['id'];
        $subject = Subject::find($id);
        $subject->name = $input['name'];

        if ($subject->save()) {
            Session::flash('success', 'Chúc mừng bạn đã cập nhật bộ môn thành công!');
            return redirect(route('admin.showSubject'));
        } else {
            $saveError = 'Đã có lỗi xảy ra trong quá trình lưu';
            $request->flash();
        }


        $subjects = Subject::paginate(15);

        $data = [
            'editSubject' => $subject,
            'subjects' => $subjects,
            'saveError' => $saveError

        ];
        return view('admin.subject.subject', $data);
    }

    public function DeleteSubject(Request $request)
    {
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
