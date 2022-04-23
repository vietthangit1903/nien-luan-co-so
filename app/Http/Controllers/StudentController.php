<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\UpdateStudentProfileRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
}
