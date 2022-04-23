<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLectureProfileRequest;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
}
