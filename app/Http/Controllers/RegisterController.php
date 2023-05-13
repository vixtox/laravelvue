<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(){

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'tipo' => '',
        ]);

        $user = User::create(request(['name','email','password','tipo']));

        auth()->login($user);
        return redirect()->to('/');
    }

}
