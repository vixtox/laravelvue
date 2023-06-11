<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
        .azul {
            background-color: #77a9ca;
        }

        .complemento {
            margin-top: 1%;
            margin-bottom: 1%;
        }

        .gris {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        .m_izq {
            margin-left: 40%;
        }

        .m_der {
            margin-right: 40%;
        }

        .listar {
            margin-left: 45%;
            margin-right: 45%;
            margin-bottom: 1%;
            margin-top: 1%;
        }

        .inputListar {
            width: 50%;
            margin-bottom: 1%;
        }

        .botonListar {
            width: 10%;
            margin-bottom: 1%;
        }

        .cuenta {
            border: 1px solid white;
            border-radius: 5px;
            color: white;
            display: inline-block;
        }

        .cuenta:hover {
            background-color: black;
        }

        .subrayado {
            text-decoration: none;
        }

    </style>

    <title>@yield('title')</title>

</head>

<body>

    <div id="app">@yield('contenido')</div>

    <div>@yield('footer')</div>

    <script>window.userRole = "{{ Auth::check() ? Auth::user()->tipo : '' }}";</script>

    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Script que cierra un group-item al abrir otro distinto --}}
    <script>
        $(document).ready(function() {
            $('.list-group-item').on('click', function() {
                $('.collapse.show').each(function() {
                    $(this).collapse('hide');
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ocultar o mostrar el menú lateral según el tamaño de la pantalla
            function toggleMenu() {
                if ($(window).width() < 992) {
                    $("#navbarMenuHamburguesa").hide();
                } else {
                    $("#navbarMenuHamburguesa").show();
                }
            }

            // Mostrar/ocultar el menú lateral al hacer clic en el botón de hamburguesa
            $(".navbar-toggler").click(function() {
                $("#navbarMenuHamburguesa").toggle();
            });

            // Ocultar o mostrar el menú lateral al cargar y redimensionar la ventana
            $(window).on("load resize", function() {
                toggleMenu();
                $("#navbarMenu").show(); // Mostrar siempre el elemento con id "navbarMenu"
            });

            // Cerrar el menú lateral al hacer clic en un submenú
            $(".list-group-item-action").click(function() {
                if ($(window).width() < 992) {
                    $("#navbarMenuHamburguesa").hide();
                }
            });
        });
    </script>

</body>

</html>
