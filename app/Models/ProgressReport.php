<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $table = 'progress_report';
    public $timestamps = false;


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
