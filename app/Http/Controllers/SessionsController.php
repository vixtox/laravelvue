<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $credentials = request(['email', 'password']);

        if (auth()->attempt($credentials) == false) {
            return back()->withErrors([
                'message' => 'Email o contraseña incorrecta',
            ]);
        }

        return redirect()->to('/index');
    }


    public function destroy()
    {

        auth()->logout();
        // Auth::logout();

        return redirect()->route('login.index');
    }
}
