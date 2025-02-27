<?php

namespace App\Repositories;

use App\Models\Role;


class RoleRepository
{
    public function index()
    {
        $data =  Role::get();
        return view('admin.role.index', compact('data'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store($request)
    {
        $validatedData = $request->validated();    

        Role::create($validatedData);
        return redirect()->route('role.index')->with('success', 'Role created successfully!');
    }

    public function edit($role)
    {
        return view('admin.role.edit', compact('role'));
    }
    public function update($request, $role)
    {
        $validatedData = $request->validated();        
        $role->update($validatedData);
        return redirect()->route('role.index')->with('success', 'Role updated successfully!');
    }

    public function destroy($role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }
}
