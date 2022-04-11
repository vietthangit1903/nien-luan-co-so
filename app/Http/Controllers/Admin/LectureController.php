<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academic_rank;
use App\Models\Admin\Subject;
use App\Models\Lecture;
use App\Models\Position;
use Illuminate\Http\Request;

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
}
