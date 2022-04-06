<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    public function ShowSubject()
    {
        $subjects = Subject::paginate(15);

        $data = [
            'subjects' => $subjects
        ];
        // dd($data);
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

        $subjects = Subject::paginate(15);

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

        $subjects = Subject::paginate(15);

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
}
