<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TeacherDetail;
use App\Models\StudentDetail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'profile_type' => ['required', 'string', 'max:255'],
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_type' => $request->profile_type,
            'password' => Hash::make($request->password),
        ]);


        // Dispatch the verification event
        $user->sendEmailVerificationNotification();         
    
        // Assign role based on profile_type
        $user->assignRole($request->profile_type);

    
        // Save additional details based on profile_type
        if ($request->profile_type === 'teacher') {
            $user->teacherDetails()->create([
                'name' => $request->name,
            ]);
        } elseif ($request->profile_type === 'student') {
            $user->studentDetails()->create([
                'name' => $request->name,
                
            ]);
        }
        elseif ($request->profile_type === 'institution') {
            $user->institutionDetails()->create([
                'name' => $request->name,
            ]);
        }
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect()->route('verification.notice')->with('id', $user->id);
    }
}
