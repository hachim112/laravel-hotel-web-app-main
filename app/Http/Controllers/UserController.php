<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = \App\Models\User::all();
        return view('admin.users.index', compact('users'));
    }
    
    public function create() {
        return view('admin.users.create');
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,receptionis,customer',
            'password' => 'required|min:6|confirmed',
        ]);
        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('admin.users')->with('success', 'User created!');
    }
    
    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }
    
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,receptionis,customer',
        ]);
        $user->update($request->only('name', 'email', 'role'));
        return redirect()->route('admin.users')->with('success', 'User updated!');
    }
    
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted!');
    }
}
