<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Http\Requests\MascotaRequest;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mascotas = Mascota::with('especie')
            ->with('cliente')
            ->where('deleted_at', NULL)
            ->paginate(5);

        // Modificar el contenido de $mascotas
        $mascotas->getCollection()->transform(function ($mascota) {
            $mascota->especie_id = $mascota->especie ? $mascota->especie->especie : null;
            $mascota->razas_id = $mascota->raza ? $mascota->raza->raza : null;
            $nombre_apellidos = $mascota->cliente->nombre_apellidos ?? null;
            $mascota->nombre_cliente = $nombre_apellidos; // Renombramos el atributo para evitar confusiones
            $mascota->cliente_id = $mascota->cliente->id; // Agregamos el ID del cliente al objeto mascota
            return $mascota;
        });

        return response()->json([
            'mascotas' => $mascotas->items(),
            'currentPage' => $mascotas->currentPage(),
            'lastPage' => $mascotas->lastPage(),
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
    public function store(MascotaRequest $request)
    {
        Mascota::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $mascota = Mascota::with('cliente')->find($id);
        if ($mascota) {
            $nombre_apellidos = $mascota->cliente->nombre_apellidos ?? null;
            $mascota->nombre_cliente = $nombre_apellidos; // Renombramos el atributo para evitar confusiones
            $mascota->cliente_id = $mascota->cliente->id; // Agregamos el ID del cliente al objeto mascota
            return response()->json($mascota);
        } else {
            return response()->json(['error' => 'Mascota no encontrada'], 404);
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
    public function update(MascotaRequest $request, $id)
    {
        $mascota = Mascota::find($id);
        $mascota->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mascota = Mascota::find($id);
        if ($mascota) {
            $mascota->delete();
            return response()->json(['message' => 'La mascota ha sido eliminado correctamente.']);
        } else {
            return response()->json(['message' => 'La mascota no existe.'], 404);
        }
    }

    public function restore($id)
    {
        $mascota = Mascota::withTrashed()->find($id);
        if ($mascota) {
            $mascota->restore();
            return response()->json(['message' => 'La mascota ha sido restaurado correctamente.']);
        } else {
            return response()->json(['message' => 'La mascota no existe.'], 404);
        }
    }

    public function buscarMascotas(Request $request)
    {
        $term = $request->query('search');
        $mascotas = Mascota::where('nombre', 'LIKE', '%' . $term . '%')->get();
        return response()->json($mascotas);
    }

}
