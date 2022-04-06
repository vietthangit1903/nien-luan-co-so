<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;

class Subject extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subject';

    public $timestamps = false;


    public $errors = [];
    public function Validate($name)
    {
        if ($name ==  null) {
            $this->errors['notNull'] = 'Bạn phải nhập tên bộ môn';
        }

        $subject = Subject::where('name', $name)->first();
        if($subject)
            $this->errors['isExist'] = 'Bộ môn đã tồn tại, vui lòng nhập tên bộ môn khác';

        if (!empty($this->errors))
            return false;


        return true;
    }
}
