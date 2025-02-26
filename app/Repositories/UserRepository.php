<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;


class UserRepository
{
    public function index()
    {
        $data =  User::get();
        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('admin.user.create',compact('roles'));
    }

    public function store($request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = uploadImage($request->file('image'), 'user');
            $validatedData['image'] = $imagePath;
        }

        User::create($validatedData);
        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function edit($user)
    {
        return view('admin.user.edit', compact('user'));
    }
    public function update($request, $user)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            if ($user->image) {
                $oldImagePath = public_path($user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imagePath = uploadImage($request->file('image'), 'user');
            $validatedData['image'] = $imagePath;
        }

        $user->update($validatedData);
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    public function destroy($user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
