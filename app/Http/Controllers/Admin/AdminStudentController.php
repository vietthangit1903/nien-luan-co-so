<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminStudentController extends Controller
{
    public function ShowStudentList()
    {
        $students = Student::paginate(10);

        $data = [
            'students' => $students
        ];

        if (request()->ajax()) {
            $html = view('admin.student.student-table', ['students' => $students])->render();

            return response()->json(['data' => $html]);
        }

        return view('admin.student.student', $data);
    }

    public function UpdateStudentInfoView(Request $request)
    {
        $id = $request->query('id');
        $student = Student::find($id);

        if ($student) {
            $subjects = Subject::all();
            $data = [
                'subjects' => $subjects,
                'student' => $student
            ];
            return view('admin.student.updateStudent', $data);
        }
        
        return back()->with('error', 'Không có thông tin sinh viên');
    }

    public function UpdateStudent(Request $request){
        $input = $request->all();
        $student = Student::find($input['id']);
        if($student){
            $student->subject_id = $input['subject_id'];
            if($student->save())
                return redirect()->route('admin.studentList')->with('success', 'Bạn đã cập nhật thông tin thành công');
            return back()->withInput()->with('error', 'Đã có lỗi trong quá trình lưu');
        }
        return back()->with('error', 'Không có thông tin sinh viên');
    }

    public function DeleteStudent(Request $request)
    {
        $id = $request->input('id');        
        $student = Student::find($id);


        if ($request->ajax()) {
            if ($student) {
                if ($student->delete()) {
                    return response()->json(
                        [
                            'message' => $student->fullName . ' đã được xóa thành công.'
                        ],
                        Response::HTTP_OK
                    );
                } else {
                    return response()->json(
                        [
                            'message' => 'Đã có lỗi xảy ra, không thể xóa giảng viên'
                        ],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
            return response()->json(
                [
                    'message' => 'Giảng viên không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
