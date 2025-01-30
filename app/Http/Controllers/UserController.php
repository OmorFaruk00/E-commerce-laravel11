<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PHPUnit\Metadata\Uses;

class UserController extends Controller
{
    public function index(){
        return Session::get('token');
    }
}
