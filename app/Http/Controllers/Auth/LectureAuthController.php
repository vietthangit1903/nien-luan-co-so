<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordLectureRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LectureAuthController extends Controller
{

    public function ShowLoginForm()
    {
        return view('login', ['url' => 'Lecture']);
    }

    public function Login(LoginRequest $request)
    {
        $input = $request->validated();
        $remember = $input['remember'] ?? false;

        if (Auth::guard('lecture')->attempt(['email' => $input['email'], 'password' => $input['password']], $remember)) {
            Session::flash('success', 'Chào mừng bạn đến với hệ thống');
            if(strcmp($input['password'], 'Abc@12345') == 0)
                return redirect()->route('LectureChangePassword')->with('firstLogin', true);
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput()->with('error', 'Thông tin bạn nhập không chính xác');
        }
    }

    public function Logout(Request $request)
    {
        Auth::guard('lecture')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(
            [],
            Response::HTTP_OK
        );
    }

    public function ShowChangePassword()
    {
        return view('changePassword', ['url' => 'Lecture']);
    }

    public function ChangePassword(ChangePasswordLectureRequest $request)
    {
        $input = $request->validated();
        // dd(strcmp($input['current_password'], $input['password'] != 0));
        if (Hash::check($input['current_password'], Auth::guard('lecture')->user()->password)) {
            if (strcmp($input['current_password'], $input['password']) != 0) {
                $lecture = Lecture::find(Auth::guard('lecture')->id());
                $lecture->password = Hash::make($input['password']);
                if($lecture->save())
                    return redirect()->back()->with('success', 'Bạn đã cập nhật thành công');
                return redirect()->back()->withInput()->with('error', 'Đã có lỗi xảy ra trong quá trình lưu');
                
            }
            return redirect()->back()->withInput()->with('error', 'Mật khẩu mới và mật khẩu cũ không được giống nhau');
        }
        return redirect()->back()->withInput()->with('error', 'Thông tin bạn nhập không chính xác');
    }
}
