<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function showUser()
    {
        $user = User::all();

        return view('users', compact('user'));
    }

    public function add(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'Email already exists!');
        }

        if ($request->password !== $request->confirmpassword) {
            return back()->with('error', 'Passwords do not match!');
        }

        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'User added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User not found!');
        }

        $hasChanges = false;

        if ($request->fullname != $user->name) {
            $user->name = $request->fullname;
            $hasChanges = true;
        }

        if ($request->email != $user->email) {

            if (User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->exists()
            ) {
                return back()->with('error', 'Email already exists!');
            }

            $user->email = $request->email;
            $hasChanges = true;
        }

        if ($request->filled('password') || $request->filled('confirmpassword')) {

            if ($request->password !== $request->confirmpassword) {
                return back()->with('error', 'Passwords do not match!');
            }

            $user->password = Hash::make($request->password);
            $hasChanges = true;
        }

        if (!$hasChanges) {
            return back();
        }

        $user->save();

        return back()->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {

        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User not found!');
        }

        $user->delete();

        return back()->with('success', 'User deleted sucessfully!');
    }
}
