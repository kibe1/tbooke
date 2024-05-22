<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sender_id',
        'type',
        'follower_name',
        'message',
    ];

    /**
     * Get notifications for a specific user.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */

     public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    public static function getUserNotifications($userId)
    {
        // return self::where('user_id', $userId)->orderByDesc('created_at')->get();
        return self::where('user_id', $userId)
        ->where('read', 0) // Only fetch unread notifications
        ->orderByDesc('created_at')
        ->get();
    }

    public static function markAsRead($userId)
    {
        self::where('user_id', $userId)->where('read', 0)->update([
            'read' => 1,
        ]);
    }
}
