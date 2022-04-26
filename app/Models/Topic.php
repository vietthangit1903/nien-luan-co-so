<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topic';

    public $timestamps = false;

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function topic_type()
    {
        return $this->belongsTo(TopicType::class, 'topic_type_id');
    }
}
