<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluation';
    public $timestamps = false;

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
}
