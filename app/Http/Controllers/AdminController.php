<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();

        // Return the view and pass the users data
        return view('auth.user', compact('users'));
    }

    public function create()
    {
        // Return the view for creating a new user
        return view('auth.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // Redirect back with a success message
        return redirect()->route('auth.user')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        // Return the view for editing the user
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        // Update the user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);

        // Redirect back with a success message
        return redirect()->route('auth.user')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('auth.user')->with('success', 'User deleted successfully');
    }
}
