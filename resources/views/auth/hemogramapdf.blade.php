<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hemograma</title>
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
            <h1>Hemograma {{ $hemograma->animal }}</h1>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Propietario</th>
                <th>Fecha hemograma</th>
            </tr>
             <tr>
                <td>
                    {{ $mascota->nombre }}
                </td>
                <td>
                    {{ $cliente->nombre_apellidos }}
                </td>
                <td>
                    {{ date('d/m/Y', strtotime($visita->fecha_visita)) }}
                </td>
            </tr>
            <tr>
                <th>Parámetro</th>
                <th>Resultado</th>
                <th>Referencia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hematocrito:</td>
                <td>
                    {{ $hemograma->hematocrito }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '37-55' : '30-45' }} (%)
                </td>

            </tr>
            <tr>
                <td>Hemoglobina:</td>
                <td>
                    {{ $hemograma->hemoglobina }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '12-18' : '8-15' }} (g/dl)
                </td>
            </tr>
            <tr>
                <td>Recuento G. rojos:</td>
                <td>
                    {{ $hemograma->g_rojo }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '5,5-8,5' : '5-10' }} (millones/µl)
                </td>
            </tr>
            <tr>
                <td>VCM:</td>
                <td>
                    {{ $hemograma->vcm }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '60-77' : '39-55' }} (fL)
                </td>
            </tr>
            <tr>
                <td>HCM:</td>
                <td>
                    {{ $hemograma->hcm }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '19,5-24,5' : '12,5-17,5' }} (pg)
                </td>
            </tr>
            <tr>
                <td>CHCM:</td>
                <td>
                    {{ $hemograma->chcm }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '32-36' : '30-36' }} (g/dl)
                </td>
            </tr>
            <tr>
                <td>Reticulocitos:</td>
                <td>
                    {{ $hemograma->reticulocitos }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? 'hasta 1' : 'hasta 1,5' }} (%)
                </td>
            </tr>
            <tr>
                <td>Leucocitos:</td>
                <td>
                    {{ $hemograma->leucocitos }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '6000-18000' : '5500-19500' }} (/&micro;l)
                </td>
            </tr>
            <tr>
                <td>Eosinófilos:</td>
                <td>
                    {{ $hemograma->eosinofilos }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '100-1250' : '0-1500' }} (/&micro;l)
                </td>
            </tr>
            <tr>
                <td>Linfocitos:</td>
                <td>
                    {{ $hemograma->linfocitos }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '1000-4800' : '1500-7000' }} (/&micro;l)
                </td>
            </tr>
            <tr>
                <td>Monocitos:</td>
                <td>
                    {{ $hemograma->monocitos }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '150-1350' : '0-850' }} (/&micro;l)
                </td>
            </tr>
            <tr>
                <td>Plaquetas:</td>
                <td>
                    {{ $hemograma->plaquetas }}
                </td>
                <td>
                    {{ $hemograma->animal === "perro" ? '150-500' : '300-700' }} (miles/&micro;l)
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
