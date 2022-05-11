<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';
    public $timestamps = false;


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function evaluation(){
        return $this->hasOne(Evaluation::class, 'report_id');
    }
}
