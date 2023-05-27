<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Mascota;
use App\Models\Cliente;
use App\Http\Requests\VisitaRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use PDF;

class VisitaController extends Controller
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
    public function store(VisitaRequest $request)
    {
        Visita::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visita = Visita::find($id);

        if ($visita) {
            return response()->json($visita);
        } else {
            return response()->json(['error' => 'Visita no encontrada'], 404);
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
    public function update(VisitaRequest $request, $id)
    {
        $visita = Visita::find($id);
        $visita->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visita = Visita::find($id);
        if ($visita) {
            $visita->delete();
            return response()->json(['message' => 'La visita ha sido eliminada correctamente.']);
        } else {
            return response()->json(['message' => 'La visita no existe.'], 404);
        }
    }

    public function restore($id)
    {
        $visita = Visita::withTrashed()->find($id);
        if ($visita) {
            $visita->restore();
            return response()->json(['message' => 'La visita ha sido restaurada correctamente.']);
        } else {
            return response()->json(['message' => 'La visita no existe.'], 404);
        }
    }

    public function mostrarVisitasMascota($mascotas_id)
    {
        $visitas = Visita::where('mascotas_id', $mascotas_id)
            ->whereNull('deleted_at')
            ->paginate(5);

        return response()->json([
            'visitas' => $visitas->items(),
            'currentPage' => $visitas->currentPage(),
            'lastPage' => $visitas->lastPage(),
        ]);
    }

    public function generatePDF($id)
    {
        // Obtener la visita según el ID proporcionado
        $visita = Visita::findOrFail($id);

        // Obtener la mascota asociada a la visita
        $mascota = Mascota::findOrFail($visita->mascotas_id);

        // Obtener el cliente asociado a la mascota
        $cliente = Cliente::findOrFail($mascota->cliente_id);

        // Generar el contenido del PDF utilizando el paquete DomPDF
        $pdf = PDF::loadView('auth.visitaspdf', compact('visita', 'mascota', 'cliente'));

        // Devolver el PDF como una respuesta descargable
        return $pdf->stream('nombre_del_archivo.pdf');
    }

    public function enviarCorreo($id)
    {
        // Obtener la visita según el ID proporcionado
        $visita = Visita::findOrFail($id);

        // Obtener la mascota asociada a la visita
        $mascota = Mascota::findOrFail($visita->mascotas_id);

        // Obtener el cliente asociado a la mascota
        $cliente = Cliente::findOrFail($mascota->cliente_id);

        $pdf = PDF::loadView('auth.visitaspdf', compact('visita', 'mascota', 'cliente'));
        $pdf_content = $pdf->output();
        $subject = "Visita $mascota->nombre $visita->fecha_visita";
        $subject = 'Don Can: visita de ' . $mascota->nombre;;
        $to = $cliente->email;
        $body = 'Gracias por visitar nuestra clínica, le adjuntamos documento de la visita';

        Mail::raw($body, function (Message $message) use ($to, $subject, $pdf_content) {
            $message->to($to)
                ->subject($subject)
                ->attachData($pdf_content, 'visita.pdf');
        });
    }
}
