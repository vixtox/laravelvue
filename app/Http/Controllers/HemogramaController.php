<?php

namespace App\Http\Controllers;

use App\Models\Hemograma;
use App\Models\Mascota;
use App\Models\Visita;
use App\Models\Cliente;
use App\Http\Requests\HemogramaRequest;
use PDF;

class HemogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HemogramaRequest $request)
    {
        Hemograma::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hemograma = Hemograma::find($id);

        $visita = Visita::findOrFail($hemograma->visita_id);

        $mascota = Mascota::findOrFail($visita->mascotas_id);

        $cliente = Cliente::findOrFail($mascota->cliente_id);

        // Devolver los objetos como respuesta JSON
        return response()->json([
            'hemograma' => $hemograma,
            'visita' => $visita,
            'cliente' => $cliente,
            'mascota' => $mascota
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HemogramaRequest $request, $id)
    {
        $hemograma = Hemograma::find($id);
        $hemograma->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generatePDF($id)
    {
        // Obtener la visita según el ID proporcionado
        $visita = Visita::findOrFail($id);
        // Obtener la mascota asociada a la visita
        $mascota = Mascota::findOrFail($visita->mascotas_id);
        // Obtener el cliente asociado a la mascota
        $cliente = Cliente::findOrFail($mascota->cliente_id);
        $hemograma = Hemograma::where('visita_id', $visita->id)->first();
    
        // Generar el contenido del PDF utilizando el paquete DomPDF
        $pdf = PDF::loadView('auth.hemogramapdf', compact('visita', 'mascota', 'cliente', 'hemograma'));

        // Devolver el PDF como una respuesta descargable
        return $pdf->stream('visita.pdf');
    }

}
