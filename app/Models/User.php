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
        'first_name','surname', 'email', 'username', 'password', 'profile_type', 'profile_picture',
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
    public function otherDetails()
    {
        return $this->hasOne(OtherDetail::class, 'id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

   //follower_id = our id
   //user_id = followed user_id


    public function followings()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    public function follows(User $user) {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function sentNotifications()
    {
        return $this->hasMany(Notification::class, 'sender_id');
    }

}