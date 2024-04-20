<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Alert;

class ProfileController extends Controller
{
        public function dashboard()
    {
        $user = Auth::user(); 
        return view('dashboard', ['user' => $user]);
    }



    // Show the user's profile.
    public function show()
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
        }

          // Convert socials string to array if it's stored as JSON in the database
          if ($profileDetails->socials) {
            $profileDetails->socials = json_decode($profileDetails->socials, true);
        }

        // Get the user's posts
        $posts = $user->posts ?? [];
        // dd($posts);

        return view('profile', [
            'user' => $user,
            'profileDetails' => $profileDetails,
            'posts' => $posts,
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

        return view('profile.edit-profile', [
            'user' => $user,
            'profileDetails' => $profileDetails,
            'favoriteTopics' => $favoriteTopics,
            'userSubjects' => $userSubjects,
            
        ]);
    }

      // Update the user's profile.
      public function update(Request $request)
      {
        $user = Auth::user();

        // Update user's name and email if provided
        if ($request->filled('name')) {
            $user->name = $request->input('name');
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
}
