<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;



class RoleController extends Controller
{
    public function ShowRole()
    {
        $roles = Role::paginate(10);

        $data = [
            'roles' => $roles
        ];

        if (request()->ajax()) {
            $html = view('admin.role.role-table', ['roles' => $roles])->render();

            return response()->json(['data' => $html]);
        }

        return view('admin.role.role', $data);
    }

    public function AddRole(Request $request)
    {
        $input = $request->all();
        $role = new Role();
        $role->name = $input['name'];
        $role->description = $input['description'];
        if ($role->ValidateOnCreate($input)) {
            if ($role->save()) {
                Session::flash('success', 'Chúc mừng bạn đã thêm phân quyền thành công!');
            } else
                $role->errors['failed'] = 'Đã có lỗi xảy ra trong quá trình lưu';
        } else{
            $request->flash();
        }


        $roles = role::paginate(10);

        $data = [
            'roles' => $roles,
            'errors' => $role->errors
        ];
        return view('admin.role.role', $data);
    }

    public function ShowEditRole(Request $request)
    {
        $id = $request->query('id');
        $editRole = Role::find($id);

        $roles = Role::paginate(10);

        $data = [
            'roles' => $roles,
            'editRole' => $editRole
        ];
        if ($editRole)
            return view('admin.role.role', $data);

        $data = [
            'roles' => $roles,
            'errors' => ['notExist' => 'Phân quyền không tồn tại']
        ];
        return view('admin.role.role', $data);
    }

    public function EditRole(Request $request){
        $input = $request->all();

        $id = $input['id'];
        $role= Role::find($id);
        $role->name = $input['name'];
        $role->description = $input['description'];

        $editRole = null;

        if ($role->ValidateOnUpdate($input)) {
            if ($role->save()) {
                Session::flash('success', 'Chúc mừng bạn đã cập nhật phân quyền thành công!');
            } else
                $role->errors['failed'] = 'Đã có lỗi xảy ra trong quá trình lưu';
        } else{
            $request->flash();
            $editRole = Role::find($id);
        }


        $roles = role::paginate(10);

        $data = [
            'roles' => $roles,
            'errors' => $role->errors,
            'editRole' => $editRole
        ];
        return view('admin.role.role', $data);
    }

    public function DeleteRole(Request $request)
    {
        $id = $request->input('id');
        $role = Role::find($id);

        if ($request->ajax()) {
            if ($role) {
                if ($role->delete()) {
                    return response()->json(
                        [
                            'message' => $role->name . ' đã được xóa thành công.'
                        ],
                        Response::HTTP_OK
                    );
                } else {
                    return response()->json(
                        [
                            'message' => 'Đã có lỗi xảy ra, không thể xóa quyền'
                        ],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
            return response()->json(
                [
                    'message' => 'Phân quyền không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
