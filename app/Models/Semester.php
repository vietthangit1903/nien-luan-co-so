<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'semester';

    public $timestamps = false;

    protected $fillable = [
        'time_start_give_topic',
        'time_end_give_topic',
        'time_start_reg_topic',
        'time_end_reg_topic',
    ];

    public function topic()
    {
        return $this->hasMany(Topic::class, 'semester_id');
    }
    
}