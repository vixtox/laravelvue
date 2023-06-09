<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Mascota;
use App\Models\Cliente;
use App\Models\Hemograma;
use App\Models\Bioquimica;
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
        $mascota = Mascota::find($visita->mascotas_id);
        $hemograma = self::getHemograma($visita->id);
        $bioquimica = self::getBioquimica($visita->id);

        return response()->json([
            'visita' => $visita,
            'mascota' => $mascota,
            'hemograma' => $hemograma,
            'bioquimica' => $bioquimica
        ]);
    }

    public static function getHemograma($visita_id)
    {
        $hemograma = Hemograma::where('visita_id', $visita_id)->get();

        return $hemograma;
    }

    public static function getBioquimica($visita_id)
    {
        $bioquimica = Bioquimica::where('visita_id', $visita_id)->get();

        return $bioquimica;
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
        return $pdf->stream('visita.pdf');
    }

    public function enviarCorreo($id)
    {
        // Obtener la visita según el ID proporcionado
        $visita = Visita::findOrFail($id);
        // Obtener la mascota asociada a la visita
        $mascota = Mascota::findOrFail($visita->mascotas_id);
        // Obtener el cliente asociado a la mascota
        $cliente = Cliente::findOrFail($mascota->cliente_id);
        // Obtener el hemograma si existe
        $hemograma = null;
        if ($visita->hemograma_id !== null) {
            $hemograma = Hemograma::where('visita_id', $visita->id)->first();
        }
        // Obtener la bioquímica si existe
        $bioquimica = null;
        if ($visita->bioquimica_id !== null) {
            $bioquimica = Bioquimica::where('visita_id', $visita->id)->first();
        }

        // Generar el PDF de la visita
        $pdf = PDF::loadView('auth.visitaspdf', compact('visita', 'mascota', 'cliente'));
        $pdf_content = $pdf->output();
        // Generar el PDF del hemograma si existe
        $pdf_content2 = null;
        if ($hemograma !== null) {
            $pdf2 = PDF::loadView('auth.hemogramapdf', compact('hemograma', 'visita', 'mascota', 'cliente'));
            $pdf_content2 = $pdf2->output();
        }
        // Generar el PDF del bioquimica si existe
        $pdf_content3 = null;
        if ($bioquimica !== null) {
            $pdf3 = PDF::loadView('auth.bioquimicapdf', compact('bioquimica', 'visita', 'mascota', 'cliente'));
            $pdf_content3 = $pdf3->output();
        }

        $subject = 'Don Can: visita de ' . $mascota->nombre;
        $to = $cliente->email;
        $body = 'Gracias por visitar nuestra clínica, le adjuntamos documento de la visita';

        // Adjuntar el PDF de la visita al correo
        Mail::raw($body, function (Message $message) use ($to, $subject, $pdf_content, $pdf_content2, $pdf_content3) {
            $message->to($to)
                ->subject($subject)
                ->attachData($pdf_content, 'visita.pdf');
            if ($pdf_content2 !== null) {
                $message->to($to)
                    ->subject($subject)
                    ->attachData($pdf_content2, 'hemograma.pdf');
            }
            if ($pdf_content3 !== null) {
                $message->to($to)
                    ->subject($subject)
                    ->attachData($pdf_content2, 'bioquimica.pdf');
            }
        });
    }

    public function inicioHemograma($id)
    {
        // Obtener la visita según el ID proporcionado
        $visita = Visita::findOrFail($id);

        // Obtener la mascota asociada a la visita
        $mascota = Mascota::findOrFail($visita->mascotas_id);

        // Obtener el cliente asociado a la mascota
        $cliente = Cliente::findOrFail($mascota->cliente_id);

        // Devolver los objetos como respuesta JSON
        return response()->json([
            'visita' => $visita,
            'cliente' => $cliente,
            'mascota' => $mascota
        ]);
    }

    public function inicioBioquimica($id)
    {
        // Obtener la visita según el ID proporcionado
        $visita = Visita::findOrFail($id);

        // Obtener la mascota asociada a la visita
        $mascota = Mascota::findOrFail($visita->mascotas_id);

        // Obtener el cliente asociado a la mascota
        $cliente = Cliente::findOrFail($mascota->cliente_id);

        // Devolver los objetos como respuesta JSON
        return response()->json([
            'visita' => $visita,
            'cliente' => $cliente,
            'mascota' => $mascota
        ]);
    }
}
