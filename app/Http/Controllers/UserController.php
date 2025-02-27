<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public $userRepository;
    public function  __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;        
    }
 
    public function index()
    {
        return $this->userRepository->index();       
    }

  
    public function create()
    {
        return $this->userRepository->create();
    }  

    public function store(UserRequest $request)    
    {
        return $this->userRepository->store($request);
    }

 
    public function show(User $user)
    {
        return $user;
    }
   
    public function edit($id)
    {
        return $this->userRepository->edit($id);
    }
  
    public function update(Request $request, User $user)
    {
        return $this->userRepository->update($request,$user);
    }
  
    public function destroy(User $user)
    {
        return $this->userRepository->destroy($user);
    }
}
