<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){

        if(auth()->attempt(request(['email', 'password'])) == false){
            return back()->withErrors([
                'message' => 'Credenciales incorrectos',
            ]);
        }
        return redirect()->to('/index');
    }

    public function destroy(){

        auth()->logout();
        // Auth::logout();

        return redirect()->to('/');
    }

}
