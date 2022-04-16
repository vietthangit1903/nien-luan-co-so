<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginLectureRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LectureAuthController extends Controller
{
    public function Login(LoginLectureRequest $request)
    {
        $input = $request->validated();
        $remember = $input['remember'] ?? false;

        if (Auth::guard('lecture')->attempt(['email' => $input['email'], 'password' => $input['password']], $remember)) {
            Session::flash('success', 'Chào mừng bạn đến với hệ thống');
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput()->with('error', 'Thông tin bạn nhập không chính xác');
        }
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(
            [
                
            ],
            Response::HTTP_OK
        );
    }
}
