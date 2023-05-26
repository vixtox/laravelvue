<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detalle de Visita</title>
    <style>
        /* Estilos CSS para el PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .header-left img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
        }
        .header-right {
            text-align: right;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
            color: #333;
        }
        td {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <img src="{{ asset('img/doncan.png') }}" alt="Logo Doncan">
            <h1>Detalle de Visita</h1>
        </div>
        <div class="header-right">
            <div>Fecha visita: {{ date('d/m/Y', strtotime($visita->fecha_visita)) }}</div>
        </div>
    </div>

    <table>
        <tr>
            <th>Propietario</th>
            <td>{{ $cliente->nombre_apellidos }}</td>
        </tr>
        <tr>
            <th>Mascota</th>
            <td>{{ $mascota->nombre }}</td>
        </tr>
        <tr>
            <th>Veterinario</th>
            <td>{{ $visita->veterinario }}</td>
        </tr>
        <tr>
            <th>Síntomas</th>
            <td>{{ $visita->sintomas }}</td>
        </tr>
        <tr>
            <th>Diagnóstico</th>
            <td>{{ $visita->diagnostico }}</td>
        </tr>
        <tr>
            <th>Tratamiento</th>
            <td>{{ $visita->tratamiento }}</td>
        </tr>
        <tr>
            <th>Coste</th>
            <td>{{ $visita->coste }}</td>
        </tr>
    </table>
</body>
</html>
