<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('img/dvapp.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #77a9ca;
        }

        .card {
            border-radius: 1rem;
        }

        .login-image {
            border-radius: 1rem 0 0 1rem;
        }

        #formulario {
            margin-left: auto;
            margin-right: auto;
            max-width: 70%;
        }

        #boton,
        h3,
        h1 {
            text-align: center;
        }

    </style>

    <title>Recuperar contraseña</title>
</head>

<body>

    <section class="vh-100">
        <div class="container py-5 h-100 d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        <img style="border-radius: 50%" src="{{ asset('img/dvapp.png') }}" alt="DVAPP"
                            width="40%">
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="fw-normal text-center mt-4 mb-3">Recuperar contraseña</h3>
                    <form method="post" action="{{ route('recuperarClave') }}" id="formulario" class="row g-3">
                        @csrf

                        <div class="col-md-12">
                            <label for="" class="form-label"><b>Email</b></label>
                            <input class="form-control form-control-lg" type="text" name="email"
                                value="{{ old('email') }}">
                            {!! $errors->first('email', '<span style="color: red;">:message</span>') !!}
                        </div>
                
                            @if (session()->has('error'))
                            <div id="boton" class="col-md-12 alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="col-md-12 alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <div id="boton" class="col-md-12">
                            <button class="btn btn-dark btn-lg btn-block">Enviar</button>
                            <a class="btn btn-warning btn-lg btn-block" href="{{ route('login.index') }}">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
