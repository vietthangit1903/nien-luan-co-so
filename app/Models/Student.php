<?php

namespace App\Models;

use App\Models\Admin\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'students';

    protected $guard = 'student';

    protected $fillable = [
        'fullName', 'email','dateOfBirth'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function performs()
    {
        return $this->hasMany(Perform::class);
    }
}
