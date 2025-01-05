<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,user,editor', // Ensure role is valid
            'active' => 'required|boolean', // Ensure active is boolean
        ]);

        // Update the user with validated data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'active' => $request->active,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }


    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function deactivate(User $user)
    {
        $user->update(['active' => false]);
        return redirect()->route('admin.users')->with('success', 'User deactivated successfully.');
    }

    public function activate(User $user)
    {
        $user->update(['active' => true]);
        return redirect()->route('admin.users')->with('success', 'User reactivated successfully.');
    }

}
