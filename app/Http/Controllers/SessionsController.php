<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $credentials = request(['email', 'password']);

        if (
            Auth::attempt($credentials) == true && $credentials['email'] === 'master@gmail.com' &&
            $credentials['password'] === 'master1234'
        ) {
            return redirect()->to('/register');
        }

        if (Auth::attempt($credentials) == false) {
            return back()->withErrors([
                'message' => 'Email o contraseña incorrecta',
            ]);
        }

        return redirect()->to('/index');
    }


    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login.index');
    }

    public function formRecuperarClave()
    {
        return view('formRecuperarClave');
    }

    public function checkEmail(Request $request)
    {

        $dataValidate = request()->validate([
            'email' => 'required'
        ]);

        $user = User::where('email', $dataValidate['email'])->first();


        if ($user != null) {

            $password = '';
            $length = 8;

            // Generar la contraseña aleatoria
            $upper = false;
            $number = false;
            while (strlen($password) < $length || !$upper || !$number) {
                $char = chr(random_int(33, 126));
                if (ctype_upper($char)) {
                    $upper = true;
                } elseif (ctype_digit($char)) {
                    $number = true;
                }
                $password .= $char;
            }

            $user->update(['password' => $password]);

            $subject = 'Recuperar contraseña';
            $to = $dataValidate['email'];
            $body = 'Su nueva contraseña es: ' . $password . ' le recomendamos eliminar el correo y actualizar la contraseña desde su cuenta.';

            Mail::raw($body, function (Message $message) use ($to, $subject) {
                $message->to($to)
                    ->subject($subject);
            });

            session()->flash('message', 'Contraseña generada, revise su email');
            return redirect('/recuperarClave');
        } else {
            session()->flash('error', 'Email incorrecto');

            return redirect('/recuperarClave');
        }
    }
}
