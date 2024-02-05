<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRegisterRequest;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function store(ValidateRegisterRequest $request){
        return register($request);
    }
}
