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
        'message',
        'read_at',
    ];

    /**
     * Get notifications for a specific user.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUserNotifications($userId)
    {
        return self::where('user_id', $userId)->orderByDesc('created_at')->get();
    }
}
