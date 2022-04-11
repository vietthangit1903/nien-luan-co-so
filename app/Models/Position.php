<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'position';

    public $timestamps = false;

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'position_id');
    }
}
