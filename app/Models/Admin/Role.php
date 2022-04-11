<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    public $timestamps = false;

    public $errors = [];
    public function ValidateOnCreate($input = [])
    {
        if ($input['name'] ==  null) {
            $this->errors['nameNotNull'] = 'Bạn phải nhập tên phân quyền';
        }

        if ($input['description'] ==  null) {
            $this->errors['descriptionNotNull'] = 'Bạn phải nhập mô tả phân quyền';
        }

        $role = Role::where('name', $input['name'])->where('description', $input['description'])->first();
        if($role)
            $this->errors['isExist'] = 'Phân quyền đã tồn tại, vui lòng nhập tên phân quyền khác';

        if (!empty($this->errors))
            return false;


        return true;
    }

    public function ValidateOnUpdate($input = [])
    {
        if ($input['name'] ==  null) {
            $this->errors['nameNotNull'] = 'Bạn phải nhập tên phân quyền';
        }

        if ($input['description'] ==  null) {
            $this->errors['descriptionNotNull'] = 'Bạn phải nhập mô tả phân quyền';
        }

        if (!empty($this->errors))
            return false;


        return true;
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'role_id');
    }


}
