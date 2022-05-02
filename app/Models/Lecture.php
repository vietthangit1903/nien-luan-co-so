<?php

namespace App\Models;

use App\Models\Admin\Role;
use App\Models\Admin\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lecture extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'lectures';

    protected $guard = 'lecture';

    protected $fillable = [
        'fullName', 'email', 'dateOfBirth'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function academic()
    {
        return $this->belongsTo(Academic_rank::class);
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }




}