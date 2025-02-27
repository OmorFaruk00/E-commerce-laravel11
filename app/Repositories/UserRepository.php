<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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
        $validatedData['password'] = Hash::make($validatedData['password']);
        unset($validatedData['role_id']);


        if ($request->hasFile('image')) {
            $imagePath = uploadImage($request->file('image'), 'user');
            $validatedData['image'] = $imagePath;
        }

       $user =  User::create($validatedData);
        if ($request->has('role_id')) {
            $user->role()->attach($request->role_id);
        }
        return redirect()->route('user.index')->with('success', 'User create successfully!');
    }

    public function edit($id)
    {
        $roles = Role::get();
        $user = User::find($id);
         $selectRole = $user->role()->first();
        return view('admin.user.edit', compact('user','roles','selectRole'));
    }
    public function update($request, $user)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone'=>'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);
        // $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            unlink($user->image);
            $image  = uploadImage($request->file('image'), 'user');
            $validatedData['image'] = $image;
        }
        unset($validatedData['password']);
        unset($validatedData['role_id']);

        $user->update($validatedData);
        if ($request->has('role_id')) {
            $user->role()->sync($request->role_id);
        }
      
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    public function destroy($user)
    {
        if ($user->image) {
            unlink($user->image);
        }

    

        $user->role()->detach();

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
