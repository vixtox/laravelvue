@extends('layouts.app')

@section('title')
    @if (isset($pageTitle))
        {{ $pageTitle }}
    @endif
@endsection

@section('contenido')
    {{-- HEADER --}}
    <nav class="navbar navbar-expand-lg navbar-light azul">
        <div class="navbar">
            <div class="d-flex align-items-center ml-4 mr-2">
                <router-link to="/" class="navbar-brand subrayado mr-auto">
                    <img id="logo" class="mr-2" style="border-radius: 50%" src="{{ asset('img/dvapp.png') }}"
                        alt="Logo" width="20%">
                    <span class="text-light">Database Veterinary App</span>
                </router-link>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenuHamburguesa"
                    aria-controls="navbarMenuHamburguesa" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <div class="navbar-collapse collapse mr-5 ml-4" id="navbarMenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white cuenta ajustar" data-toggle="dropdown">
                        <i class="fas fa-clinic-medical"></i> Don Can
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <router-link to="/micuenta" class="dropdown-item"> <i class="fas fa-user-circle"></i> Mi cuenta
                        </router-link>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item btn btn-danger logout" title="Cerrar sesión" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-left"></i> Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    {{-- MENU LATERAL --}}
    <div class="row w-100">
        <div class="col-md-2" id="navbarMenuHamburguesa">
            <div class="d-flex h-100" id="wrapper">
                <div class="bg-dark text-light border-right flex-grow-1" id="sidebar-wrapper">
                    <div class="list-group list-group-flush">
                        <router-link to="/listarclientes"
                            class="list-group-item list-group-item-action bg-dark text-light mt-4">
                            <i class="fa-solid fa-user"></i> Clientes
                        </router-link>
                        <router-link to="/" class="list-group-item list-group-item-action bg-dark text-light">
                            <i class="fas fa-paw"></i> Mascotas
                        </router-link>
                        <a href="#opcion5-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-hospital"></i> Hospitalización</a>
                        <a href="#opcion6-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-procedures"></i> Cirujías</a>
                        <a href="#opcion7-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-shopping-cart"></i> Productos</a>

                        @if (Auth::check() && Auth::user()->tipo === 'Admin')
                            <router-link to="/listarempleados"
                                class="list-group-item list-group-item-action bg-dark text-light"><i id="iconoEmpleado" class="bi bi-person-fill-gear"></i> Empleados
                            </router-link>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- COMPONENTE VUE --}}
        <div class="col-md-10">
            <div id="page-content-wrapper" class="complemento">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- FOOTER --}}
@section('footer')
    <footer class="azul text-center text-white">

        <!-- Grid container -->
        <div class="container p-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-twitter"></i></a>

                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-instagram"></i></a>

            </section>
            <!-- Section: Social media -->

            <div class="azul text-center p-3">
                <p class="text-white">© 2023 Copyright: DVAPP S.A</p>
            </div>
        </div>
    </footer>
@endsection
