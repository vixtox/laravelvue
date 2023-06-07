<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bioquímica</title>
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
        .resultados {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
            color: #333;
        }
        .cabecera{
            background-color: lightblue;
            font-weight: bold;
            text-align: left;
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
            <h1>Bioquímica {{ $bioquimica->animal }}</h1>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th class="cabecera">Mascota</th>
                <th class="cabecera">Propietario</th>
                <th class="cabecera">Fecha bioquimica</th>
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
                <th class="resultados">Parámetro</th>
                <th class="resultados">Resultado</th>
                <th class="resultados">Referencia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Urea:</td>
                <td>
                    {{ $bioquimica->urea }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '20-50' : '30-60'  }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>Creatinina:</td>
                <td>
                    {{ $bioquimica->creatinina }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '0,6-1,4' : '0,5-1,8' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>Glucosa:</td>
                <td>
                    {{ $bioquimica->glucosa }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '70-105' : '60-140' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>Proteínas totales:</td>
                <td>
                    {{ $bioquimica->proteinas }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '5,3-7,9' : '5,7-8' }} (g/dl)
                </td>
            </tr>
            <tr>
                <td>Albumina:</td>
                <td>
                    {{ $bioquimica->albumina }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '2,3-3,8' : '2,3-3,4' }} (g/dl)
                </td>
            </tr>
            <tr>
                <td>Bilirrubina:</td>
                <td>
                    {{ $bioquimica->bilirrubina }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? 'Hasta 0,8' : 'Hasta 0,8' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>ALP:</td>
                <td>
                    {{ $bioquimica->alp }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '32-185' : '25-110' }} (U/L)
                </td>
            </tr>
            <tr>
                <td>GPT:</td>
                <td>
                    {{ $bioquimica->gpt }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '28-78' : '10-80' }} (U/L)
                </td>
            </tr>
            <tr>
                <td>Fósforo:</td>
                <td>
                    {{ $bioquimica->fosforo }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '2-6,2' : '2,8-7,2' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>Calcio:</td>
                <td>
                    {{ $bioquimica->calcio }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '7-11,5' : '7-11,0' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>Colesterol:</td>
                <td>
                    {{ $bioquimica->colesterol }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '135-260' : '80-180' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>Trigliceridos:</td>
                <td>
                    {{ $bioquimica->trigliceridos }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '25-120' : '25-120' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>Lípidos:</td>
                <td>
                    {{ $bioquimica->lipidos }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '100-700' : '140-600' }} (mg/dl)
                </td>
            </tr>
            <tr>
                <td>CPK:</td>
                <td>
                    {{ $bioquimica->cpk }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? 'Hasta 300' : '50-450' }} (U/L)
                </td>
            </tr>
            <tr>
                <td>Amilasa:</td>
                <td>
                    {{ $bioquimica->amilasa }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? 'Hasta 1500' : '500-1500' }} (U/L)
                </td>
            </tr>
            <tr>
                <td>Lipasa:</td>
                <td>
                    {{ $bioquimica->lipasa }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? 'Hasta 240' : 'Hasta 75' }} (U/L)
                </td>
            </tr>
            <tr>
                <td>Sodio:</td>
                <td>
                    {{ $bioquimica->sodio }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '135-150' : '140-150' }} (meq/L)
                </td>
            </tr>
            <tr>
                <td>Potasio:</td>
                <td>
                    {{ $bioquimica->potasio }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '3,6-5,8' : '3,6-5,5' }} (meq/L)
                </td>
            </tr>
            <tr>
                <td>Cloro:</td>
                <td>
                    {{ $bioquimica->cloro }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '105-120' : '108-128' }} (meq/L)
                </td>
            </tr>
            <tr>
                <td>T4:</td>
                <td>
                    {{ $bioquimica->t4 }}
                </td>
                <td>
                    {{ $bioquimica->animal === "perro" ? '0,6-2,8' : '0,6-2,6' }} μg/dL
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
