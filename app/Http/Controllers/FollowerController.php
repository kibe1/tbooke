<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class FollowerController extends Controller
{
    public function follow (User $user)
    {
      $follower = auth()->user();
      $follower->followings()->attach($user);

      $message = $follower->first_name .' '. $follower->surname . ' started following you.';

  

       // Create a notification for the user being followed
        Notification::create([
          'user_id' => $user->id,
          'sender_id' => $follower->id,
          'message' => $message,
      ]);

      return response()->json(['message' => 'Followed successfully'], 200);
    }

    public function unfollow (User $user)
    {
      $follower = auth()->user();
      $follower->followings()->detach($user);

      return response()->json(['message' => 'Unfollowed successfully'], 200);
    }
}
