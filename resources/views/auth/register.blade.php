<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('img/dvapp.png') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/94d5779c24.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/dvapp.png') }}">
    <style>
        body {
            background-color: #77a9ca;
        }

        .container {
            margin-top: 50px;
            padding: 10px;
        }

        .half-width {
            width: 40%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <title>Registrar usuario</title>
</head>

<body>

    <div class="container">

        <div class="card half-width">
            <div class="card-header">
                <div class="text-center">
                    @if (Auth::check())
                        <a class="btn btn-danger logout" title="Cerrar sesión" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            style="position: absolute; top: 0; right: 0;">
                            Exit <i class="bi bi-box-arrow-left"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                    <img style="border-radius: 50%" src="{{ asset('img/dvapp.png') }}" alt="DVAPP" width="30%">
                </div>
            </div>
            <div class="card-body">
                <h1>Registrar usuario</h1>

                <form action="" method="POST">
                    @csrf

                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" placeholder="name" id="name" name="name">

                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror

                    <label for="email">Email</label>
                    <input class="form-control" type="email" placeholder="email" id="email" name="email">

                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror

                    <div class="form-check">
                        <label class="form-check-label" for="tipo">Admin</label>
                        <input class="form-check-input" type="checkbox" id="tipo" name="tipo" value="Admin">
                    </div>

                    <label for="password">Contraseña</label>
                    <input class="form-control" type="password" placeholder="password" id="password" name="password">

                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror

                    <label for="password_confirmation">Confirma contraseña</label>
                    <input class="form-control" type="password" placeholder="password_confirmation"
                        id="password_confirmation" name="password_confirmation">
                    <br>
                    <button class="btn btn-dark" type="submit">Enviar</button>

                </form>
            </div>
        </div>
    </div>

</body>

</html>
