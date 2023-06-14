<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class PagOficialTest extends TestCase
{
 
    /**
     * Prueba para la ruta '/'
     */
    // public function testHomeRoute()
    // {
    //     $response = $this->get(route('/'));
    //     $response->assertViewIs('home');
    //     $response->assertStatus(200);
    // }

    /**
     * Prueba para la ruta '/sobrenosotros'
     */
    public function testSobreNosotrosRoute()
    {
        $response = $this->get(route('/sobrenosotros'));
        $response->assertViewIs('sobrenosotros');
        $response->assertStatus(200);
    }

    // /**
    //  * Prueba para la ruta '/servicios'
    //  */
    // public function testServiciosRoute()
    // {
    //     $response = $this->get('/servicios');
    //     $response->assertViewIs('servicios');
    //     $response->assertStatus(200);
    // }

    // /**
    //  * Prueba para la ruta '/contacto'
    //  */
    // public function testContactoRoute()
    // {
    //     $response = $this->get('/contacto');
    //     $response->assertViewIs('contacto');
    //     $response->assertStatus(200);
    // }

    // /**
    //  * Prueba para la ruta '/precios'
    //  */
    // public function testPreciosRoute()
    // {
    //     $response = $this->get('/precios');
    //     $response->assertViewIs('precios');
    //     $response->assertStatus(200);
    // }

    // /**
    //  * Prueba para la ruta '/testimonios'
    //  */
    // public function testTestimoniosRoute()
    // {
    //     $response = $this->get('/testimonios');
    //     $response->assertViewIs('testimonios');
    //     $response->assertStatus(200);
    // }
}
