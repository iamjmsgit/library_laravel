<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('profile');
    }

    public function profile(Request $request)
    {
        $user = User::find(session('user')->id);

        // Upload Image if there is a value
        if ($request->hasFile('profile_pic')) {

            $file = $request->file('profile_pic');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/images'), $filename);

            $user->profile_pic = $filename;
        }

        // Only update name if the input exists
        if ($request->has('fullname')) {
            $user->name = $request->fullname;
        }

        // Select * from users where email = '$email'
        // This checks if email already exists except the current user
        if ($request->has('email')) {
            if (User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->exists()
            ) {
                return back()->with('error', 'Email already exists!');
            }

            $user->email = $request->email;
        }

        // Change password if new password has value
        if ($request->filled('new_pass') || $request->filled('confirm_pass')) {

            if ($request->new_pass !== $request->confirm_pass) {
                return back()->with('error', 'Passwords do not match!');
            }

            $user->password = Hash::make($request->new_pass);
        }

        $user->save();

        session(['user' => $user]);

        return back()->with('success', 'Profile updated successfully!');
    }
}
