<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topic_type';

    public $timestamps = false;

    public function topics()
    {
        return $this->hasMany(Topic::class, 'topic_type_id');
    }
}
