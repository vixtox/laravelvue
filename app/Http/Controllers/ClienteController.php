<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Provincia;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $clientes = Cliente::with('provincia')
            ->where('deleted_at', NULL)
            ->paginate(5);

        // Modificar el contenido de $clientes
        $clientes->getCollection()->transform(function ($cliente) {
            $cliente->provincia_id = $cliente->provincia ? $cliente->provincia->provincia : null;
            $cliente->municipio_id = $cliente->municipio ? $cliente->municipio->municipio : null;
            return $cliente;
        });

        return response()->json([
            'clientes' => $clientes->items(),
            'currentPage' => $clientes->currentPage(),
            'lastPage' => $clientes->lastPage(),
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
    public function store(ClienteRequest $request)
    {
        Cliente::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cliente = Cliente::find($id);

        if ($cliente) {
            return response()->json($cliente);
        } else {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
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
    public function update(ClienteRequest $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->update($request->all());
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
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->delete();
            return response()->json(['message' => 'El cliente ha sido eliminado correctamente.']);
        } else {
            return response()->json(['message' => 'El cliente no existe.'], 404);
        }
    }

    public function restore($id)
    {
        $cliente = Cliente::withTrashed()->find($id);
        if ($cliente) {
            $cliente->restore();
            return response()->json(['message' => 'El cliente ha sido restaurado correctamente.']);
        } else {
            return response()->json(['message' => 'El cliente no existe.'], 404);
        }
    }

    public function buscarClientes(Request $request)
    {
        $term = $request->query('search');
        $clientes = Cliente::where('nombre_apellidos', 'LIKE', '%' . $term . '%')->get();
        return response()->json($clientes);
    }
}
