<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStudentPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Admin\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class StudentAuthController extends Controller
{
    public function ShowRegisterForm()
    {
        $subjects = Subject::all();
        return view('student.studentRegister', ['subjects' => $subjects]);
    }

    public function RegisterStudent(RegisterStudentRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $student = new Student();
        $student->fullName = $input['fullName'];
        $student->email = $input['email'];
        $student->password = $input['password'];
        $student->dateOfBirth = $input['dateOfBirth'];
        $student->subject_id = $input['subject_id'];

        if ($student->save()) {
            Session::flash('success', 'Bạn đã đăng ký thành công tài khoản');
            return view('login');
        }
        return redirect()->back()->withInput()->with('error', 'Đã có lỗi trong quá trình lưu');
    }

    public function ShowLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function Login(LoginRequest $request)
    {
        $input = $request->validated();
        $remember = $input['remember'] ?? false;

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $remember)) {
            Session::flash('success', 'Chào mừng bạn đến với hệ thống');
            return redirect()->route('home');
        }
        return redirect()->back()->withInput()->with('error', 'Thông tin bạn nhập không chính xác');
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(
            [],
            Response::HTTP_OK
        );
    }

    public function ShowChangePassword()
    {
        return view('changePassword');
    }

    public function ChangePassword(ChangeStudentPasswordRequest $request)
    {
        $input = $request->validated();
        if (Hash::check($input['current_password'], Auth::user()->password)) {
            if (strcmp($input['current_password'], $input['password']) != 0) {
                $student = Student::find(Auth::id());
                $student->password = Hash::make($input['password']);
                if($student->save())
                    return redirect()->back()->with('success', 'Bạn đã cập nhật thành công');
                return redirect()->back()->withInput()->with('error', 'Đã có lỗi xảy ra trong quá trình lưu');
                
            }
            return redirect()->back()->withInput()->with('error', 'Mật khẩu mới và mật khẩu cũ không được giống nhau');
        }
        return redirect()->back()->withInput()->with('error', 'Thông tin bạn nhập không chính xác');
    }
}
