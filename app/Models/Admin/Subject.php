<?php

namespace App\Models\Admin;

use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subject';

    public $timestamps = false;

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'subject_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'subject_id');
    }


}
