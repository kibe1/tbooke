<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Import the HasRoles trait


class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use Notifiable;
    
    protected $fillable = [
        'name', 'email', 'password', 'profile_type', 'profile_picture',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function teacherDetails()
    {
        return $this->hasOne(TeacherDetail::class, 'id');
    }

    public function studentDetails()
    {
        return $this->hasOne(StudentDetail::class, 'id');
    }
    public function institutionDetails()
    {
        return $this->hasOne(InstitutionDetail::class, 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
}