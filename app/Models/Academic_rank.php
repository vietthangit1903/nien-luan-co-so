<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academic_rank extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'academic_rank';

    public $timestamps = false;

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'academic_id');
    }
}
