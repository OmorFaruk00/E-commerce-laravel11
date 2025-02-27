<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    public $roleRepository;
    public function  __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;        
    }
 
    public function index()
    {
        return $this->roleRepository->index();       
    }

  
    public function create()
    {
        return $this->roleRepository->create();
    }  

    public function store(RoleRequest $request)    
    {
        return $this->roleRepository->store($request);
    }

 
    public function show(Role $role)
    {
        return $role;
    }
   
    public function edit(Role $role)
    {
        return $this->roleRepository->edit($role);
    }
  
    public function update(RoleRequest $request, Role $role)
    {
        return $this->roleRepository->update($request,$role);
    }
  
    public function destroy(Role $role)
    {
        return $this->roleRepository->destroy($role);
    }
}
