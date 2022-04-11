<?php

namespace App\Models\Admin;

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
}
