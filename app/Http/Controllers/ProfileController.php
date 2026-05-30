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

        if (!$user) {
            return back()->with('error', 'User not found!');
        }

        $hasChanges = false;

        // Upload profile picture
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/images'), $filename);

            $user->profile_pic = $filename;

            $hasChanges = true;
        }

        // Update fullname only if the input exists and has value
        if ($request->filled('fullname') && $request->fullname != $user->name) {
            $user->name = $request->fullname;

            $hasChanges = true;
        }

        // Update email only if the input exists and has value
        if ($request->filled('email') && $request->email != $user->email) {

            if (User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->exists()
            ) {
                return back()->with('error', 'Email already exists!');
            }

            $user->email = $request->email;

            $hasChanges = true;
        }

        // Update phone number
        if ($request->filled('phone_number') && $request->phone_number != $user->phone_number) {
            $user->phone_number = $request->phone_number;
            $hasChanges = true;
        }

        // Update gender
        if ($request->filled('gender') && $request->gender != $user->gender) {
            $user->gender = $request->gender;
            $hasChanges = true;
        }

        // Update address
        if ($request->filled('address') && $request->address != $user->address) {
            $user->address = $request->address;
            $hasChanges = true;
        }

        // Change password only if password fields have value
        if ($request->filled('current_pass') || $request->filled('new_pass') || $request->filled('confirm_pass')) {
            if (!$request->filled('current_pass')) {
                return back()->with('error', 'Current password is required!');
            }

            if (!Hash::check($request->current_pass, $user->password)) {
                return back()->with('error', 'Current password is incorrect!');
            }

            if (!$request->filled('new_pass')) {
                return back()->with('error', 'New password is required!');
            }

            if (!$request->filled('confirm_pass')) {
                return back()->with('error', 'Confirm password is required!');
            }

            if ($request->new_pass !== $request->confirm_pass) {
                return back()->with('error', 'Passwords do not match!');
            }

            $user->password = Hash::make($request->new_pass);
            $hasChanges = true;
        }

        // If nothing changed, no toast
        if (!$hasChanges) {
            return back();
        }

        $user->save();

        session(['user' => $user]);

        return back()->with('success', 'Profile updated successfully!');
    }
}
