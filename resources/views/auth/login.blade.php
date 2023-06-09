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
    </style>

    <title>Login</title>
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
                    <h3 class="fw-normal text-center mt-4 mb-3">Login</h3>
                    <form action="" method="POST">
                        @csrf

                        <div class="form-outline mb-4">
                            <input type="email" name="email" placeholder="Email"
                                class="form-control form-control-lg" />
                            <label class="form-label" for="email">Email</label>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @error('message')
                                    {{ $message }}
                                @enderror
                            </div>
                        @endif

                        <div class="form-outline mb-4">
                            <input type="password" name="password" placeholder="Contraseña"
                                class="form-control form-control-lg" />
                            <label class="form-label" for="password">Contraseña</label>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @error('message')
                                    {{ $message }}
                                @enderror
                            </div>
                        @endif

                        <div class="pt-1 text-center">
                            <button class="btn btn-dark btn-lg" type="submit">Login</button>
                            <a href="{{ route('home') }}" class="btn btn-warning btn-lg">Volver</a>
                        </div>                        
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('recuperarClave') }}" class="text-muted">Olvidé mi contraseña</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
