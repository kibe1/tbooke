<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Creator;
use Alert;
use App\Models\User;
use App\Models\Notification;

class ProfileController extends Controller
{
        public function dashboard()
    {
        $user = Auth::user(); 
        
        // Get following count
        $notifications = Notification::where('user_id', $user->id)->orderByDesc('created_at')->get();

       
        return view('dashboard', compact('user', 'notifications'));
    }


    // Show the user's profile.
    public function showOwn()
    {
        $user = Auth::user();

        // Get the user's profile details based on their profile type
        $profileDetails = null;
        if ($user->profile_type === 'teacher') {
            $profileDetails = $user->teacherDetails;
        } elseif ($user->profile_type === 'student') {
            $profileDetails = $user->studentDetails;
        } elseif ($user->profile_type === 'institution') {
            $profileDetails = $user->institutionDetails;
        } elseif ($user->profile_type === 'other') {
            $profileDetails = $user->otherDetails;
        }

          // Convert socials string to array if it's stored as JSON in the database
          if ($profileDetails->socials) {
            $profileDetails->socials = json_decode($profileDetails->socials, true);
        }

        // Get the user's posts
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        // dd($posts);
        
        $userIsCreator = Creator::where('user_id', $user->id)->exists();
        $userIsTeacher = $user->profile_type === 'teacher';
        
        // Get followers count
        $followersCount = $user->followers()->count();

        // Get following count
        $followingCount = $user->followings()->count();

        // Get notifications
        $notifications = Notification::where('user_id', $user->id)->orderByDesc('created_at')->get();
        $notificationCount = $notifications->count();
        
        return view('profile', [
            'user' => $user,
            'profileDetails' => $profileDetails,
            'posts' => $posts,
            'userIsCreator' => $userIsCreator,
            'userIsTeacher' => $userIsTeacher,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'notifications' => $notifications,
            'notificationCount' => $notificationCount,
        ]);
    }

    // Show the edit profile form.
    public function edit()
    {
        $user = Auth::user();

        // Get the user's profile details based on their profile type
        $profileDetails = null;
        if ($user->profile_type === 'teacher') {
            $profileDetails = $user->teacherDetails;
        } elseif ($user->profile_type === 'student') {
            $profileDetails = $user->studentDetails;
        } elseif ($user->profile_type === 'institution') {
            $profileDetails = $user->institutionDetails;
        } elseif ($user->profile_type === 'other') {
            $profileDetails = $user->otherDetails;
        }

        // Convert socials string to array if it's stored as JSON in the database
        if ($profileDetails->socials) {
            $profileDetails->socials = json_decode($profileDetails->socials, true);
        }

     
      // Get favorite topics if available
      $favoriteTopics = [];
      if ($profileDetails && $profileDetails->favorite_topics) {
          $favoriteTopics = explode(',', $profileDetails->favorite_topics);
      }

      // Get subjects if available
       $userSubjects= [];
       if ($profileDetails && $profileDetails->user_subjects) {
        $userSubjects = explode(',', $profileDetails->user_subjects);
       }

       
        // Get notifications
        $notifications = Notification::where('user_id', $user->id)->orderByDesc('created_at')->get();
        $notificationCount = $notifications->count();

        return view('profile.edit-profile', [
            'user' => $user,
            'profileDetails' => $profileDetails,
            'favoriteTopics' => $favoriteTopics,
            'userSubjects' => $userSubjects,
            'notifications' => $notifications,
            'notificationCount' => $notificationCount
            
        ]);
    }

      // Update the user's profile.
      public function update(Request $request)
      {
        $user = Auth::user();

        // Update user's name and email if provided
        if ($request->filled('name')) {
            $user->first_name = $request->input('first_name');
            $user->surname = $request->input('surname');
            $user->save();
        }
        if ($request->filled('email')) {
            $user->email = $request->input('email');
            $user->save();
        }

         // Handle profile picture update
        if ($request->hasFile('profile_picture')) {

            // Delete previous profile picture if it exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }


            $file = $request->file('profile_picture');
            $fileName = 'profile_' . time() . '.' . $file->getClientOriginalExtension(); // Generate a unique file name
            $filePath = $file->storeAs('profile-images', $fileName, 'public'); // Store the file in public/profile-images
            $user->profile_picture = $filePath; // Save the image path to the database
            $user->save();
        }
  
       // Update social media links in teacher_details
        $teacherDetails = $user->teacherDetails;
        if ($teacherDetails) {
            $teacherDetails->socials = $request->input('socials');
            $teacherDetails->save();
        }

        // Update social media links in student_details
            $studentDetails = $user->studentDetails;
            if ($studentDetails) {
                $studentDetails->socials = $request->input('socials');
                $studentDetails->save();
            }
            
    
        // Update user's about profile details based on profile type
        if ($user->profile_type === 'teacher') {
            $teacherDetails = $user->teacherDetails;
            if ($teacherDetails && $request->filled('about')) {
                $teacherDetails->about = $request->input('about');
                $teacherDetails->save();
            }
        } elseif ($user->profile_type === 'student') {
            $studentDetails = $user->studentDetails;
            if ($studentDetails && $request->filled('about')) {
                $studentDetails->about = $request->input('about');
                $studentDetails->save();
            }
        }


        // Add other profile details updates here for different profile types
        
        if ($teacherDetails && $request->filled('favorite_topics')) {
            $existingTopics = explode(',', $teacherDetails->favorite_topics);
            $newTopics = $request->input('favorite_topics');
            $mergedTopics = array_unique(array_merge($existingTopics, $newTopics));
            $teacherDetails->favorite_topics = implode(',', $mergedTopics);
            $teacherDetails->favorite_topics = ltrim($teacherDetails->favorite_topics, ',');
            $teacherDetails->save();
        }

        if ($teacherDetails && $request->filled('user_subjects')) {
            $existingTopics = explode(',', $teacherDetails->user_subjects);
            $newTopics = $request->input('user_subjects');
            $mergedTopics = array_unique(array_merge($existingTopics, $newTopics));
            $teacherDetails->user_subjects = implode(',', $mergedTopics);
            $teacherDetails->user_subjects = ltrim($teacherDetails->user_subjects, ',');
            $teacherDetails->save();
        }

        if ($studentDetails && $request->filled('favorite_topics')) {
            $existingTopics = explode(',', $studentDetails->favorite_topics);
            $newTopics = $request->input('favorite_topics');
            $mergedTopics = array_unique(array_merge($existingTopics, $newTopics));
            $studentDetails->favorite_topics = implode(',', $mergedTopics);
            $studentDetails->favorite_topics = ltrim($studentDetails->favorite_topics, ',');
            $studentDetails->save();
        }
        
        if ($studentDetails && $request->filled('user_subjects')) {
            $existingSubjects = explode(',', $studentDetails->user_subjects);
            $newSubjects = $request->input('user_subjects');
            $mergedSubjects = array_unique(array_merge($existingSubjects, $newSubjects));
            $studentDetails->user_subjects = implode(',', $mergedSubjects);
            $studentDetails->user_subjects = ltrim($studentDetails->user_subjects, ',');
            $studentDetails->save();
        }
        

        Alert::Success('Profile updated successfuly');
        return redirect()->route('profile.edit');
      }

        // Show the user's profile.
        public function show($username)
        {
            $user = User::where('username', $username)->firstOrFail();

     // Get the user's profile details based on their profile type
        $profileDetails = null;
        if ($user->profile_type === 'teacher') {
            $profileDetails = $user->teacherDetails;
        } elseif ($user->profile_type === 'student') {
            $profileDetails = $user->studentDetails;
        } elseif ($user->profile_type === 'institution') {
            $profileDetails = $user->institutionDetails;
        } elseif ($user->profile_type === 'other') {
            $profileDetails = $user->otherDetails;
        }

          // Convert socials string to array if it's stored as JSON in the database
          if ($profileDetails->socials) {
            $profileDetails->socials = json_decode($profileDetails->socials, true);
        }

         // Get the user's posts
        $posts = $user->posts()->latest()->get();
        // Get following count
        $notifications = Notification::where('user_id', $user->id)->orderByDesc('created_at')->get();
        $notificationCount = $notifications->count();

            return view('profile.show', [
            'user' => $user,
            'profileDetails' => $profileDetails,
            'posts' => $posts,
            'notifications' => $notifications,
            'notificationCount' => $notificationCount,
            ]);
        }
}
