<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSemesterRequest;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function ShowSemesterList()
    {
        $semesters = Semester::paginate(10);

        $data = [
            'semesters' => $semesters
        ];
        if (request()->ajax()) {
            $html = view('admin.semester.semester-table', ['semesters' => $semesters])->render();

            return response()->json(['data' => $html]);
        }

        return view('admin.semester.semester', $data);
    }

    public function ShowEditSemester(Request $request)
    {
        $id = $request->query('id');
        $semester = Semester::find($id);
        if ($semester)
            return view('admin.semester.updateSemester', ['semester' => $semester]);
        return redirect()->back()->with('error', 'Học kỳ không tồn tại');
    }

    public function EditSemester(UpdateSemesterRequest $request)
    {
        $input = $request->validated();
        $editSemester = Semester::find($input['id']);
        if ($editSemester) {
            $editSemester->fill($input);
            if ($editSemester->save())
                return redirect()->route('admin.showSemester')->with('success', 'Bạn đã cập nhật thời gian thành công');
            return redirect()->back()->withInput()->with('error', 'Đã có lỗi trong quá trình lưu');
        }

        return redirect()->back()->withInput()->with('error', 'Học kỳ không tồn tại');
    }
}
