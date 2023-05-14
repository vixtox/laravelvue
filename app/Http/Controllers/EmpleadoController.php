<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Provincia;
use App\Http\Requests\EmpleadoRequest;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::with('provincia')
            ->where('deleted_at', NULL)
            ->paginate(5);

        // Modificar el contenido de $empleado
        $empleados->getCollection()->transform(function ($empleado) {
            $empleado->provincia_id = $empleado->provincia ? $empleado->provincia->provincia : null;
            $empleado->municipio_id = $empleado->municipio ? $empleado->municipio->municipio : null;
            return $empleado;
        });

        return response()->json([
            'empleados' => $empleados->items(),
            'currentPage' => $empleados->currentPage(),
            'lastPage' => $empleados->lastPage(),
        ]);
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
    public function store(EmpleadoRequest $request)
    {
        Empleado::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        if ($empleado) {
            return response()->json($empleado);
        } else {
            return response()->json(['error' => 'Empleado no encontrado'], 404);
        }
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
    public function update(EmpleadoRequest $request, $id)
    {
        $empleado = Empleado::find($id);
        $empleado->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        if ($empleado) {
            $empleado->delete();
            return response()->json(['message' => 'El empleado ha sido eliminado correctamente.']);
        } else {
            return response()->json(['message' => 'El empleado no existe.'], 404);
        }
    }

    public function buscarempleados(Request $request)
    {
        $term = $request->query('search');
        $empleados = Empleado::where('nombre_apellidos', 'LIKE', '%' . $term . '%')->get();
        return response()->json($empleados);
    }

}
