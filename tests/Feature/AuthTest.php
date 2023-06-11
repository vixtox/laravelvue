<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\SessionsController;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginRoute()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('login.index');
        // Agrega más aserciones según tus necesidades
    }

    // public function testLoginAction()
    // {
    //     $credentials = [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'luis1234',
    //     ];

    //     $response = $this->post('/login', $credentials);

    //     $response->assertStatus(200);
    //     // Agrega más aserciones según tus necesidades
    // }

    // public function testLogoutAction()
    // {
    //     $response = $this->post('/logout');

    //     $response->assertStatus(200);
    //     // Agrega más aserciones según tus necesidades
    // }

    // public function testRecuperarClaveRoute()
    // {
    //     $response = $this->get('/recuperarClave');

    //     $response->assertStatus(200);
    //     $response->assertViewIs('recuperarClave');
    //     // Agrega más aserciones según tus necesidades
    // }

    // public function testRecuperarClaveAction()
    // {
    //     $email = 'victor_mar_dom@hotmail.es';

    //     $response = $this->post('/recuperarClave', ['email' => $email]);

    //     $response->assertStatus(200);
    //     // Agrega más aserciones según tus necesidades
    // }

    // public function testGeneratePassRoute()
    // {
    //     $response = $this->get('/generatePass');

    //     $response->assertStatus(200);
    //     $response->assertViewIs('generatePass');
    //     // Agrega más aserciones según tus necesidades
    // }
}
