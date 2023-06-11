<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'tipo' => '',
        ]);

        $user = User::create(request(['name', 'email', 'password', 'tipo']));

        auth()->login($user);
        return redirect()->to('/');
    }

    public function getUser()
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function updateUser(Request $request, $new_pass)
    {
        $user = Auth::user();
        $user->update(['password' => $new_pass]);
    }
    

}
