@extends('layouts.app')

@section('title', 'Menú')

@section('contenido')


    <nav class="navbar navbar-expand-lg navbar-light azul">
        <router-link to="/" class="navbar-brand"><img id="logo" style="border-radius: 50%" src="{{ asset('img/dvapp.png') }}"
            alt="Logo" width="10%"><span class="text-white"><strong> Database Veterinary App</strong></span></router-link>
        <div class="d-none d-md-flex flex-nowrap menu flex-shrink-0">
            <ul class="nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown">
                        <i class="fas fa-users"></i>
                    </a>
                    <div class="dropdown-menu">
                        <router-link to="/registrarcliente" class="nav-link">Registrar Cliente</router-link>
                        <router-link to="/listarclientes" class="nav-link">Listar Clientes</router-link>
                    </div>
                </li>

                <li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-paw"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-hospital"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-vial"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-procedures"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-users-cog"></i>
                    </a>
                </li>
            </ul>

            @if (Auth::check())
                <a class="btn btn-danger" title="Cerrar sesión" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif

        </div>
    </nav>

    <div class="row w-100">
        <div class="col-md-2" id="menu">
            <div class="d-flex h-100" id="wrapper">
                <div class="bg-dark text-light border-right flex-grow-1" id="sidebar-wrapper">
                    <div class="sidebar-heading" id><span class="menu">Menú</span></div>
                    <div class="list-group list-group-flush">
                        <a href="#opcion1-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-users"></i> Clientes</a>
                        <div id="opcion1-submenu" class="collapse">
                            <router-link to="/registrarcliente"
                                class="list-group-item list-group-item-action bg-secondary text-light">Registrar cliente
                            </router-link>
                            <router-link to="/listarclientes"
                                class="list-group-item list-group-item-action bg-secondary text-light">Listar clientes
                            </router-link>
                        </div>
                        <a href="#opcion2-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-paw"></i> Mascotas</a>
                        <div id="opcion2-submenu" class="collapse">
                            <router-link to="/registrarcliente"
                                class="list-group-item list-group-item-action bg-secondary text-light">Registrar mascota
                            </router-link>
                            <router-link to="/listarclientes"
                                class="list-group-item list-group-item-action bg-secondary text-light">Listar mascotas
                            </router-link>
                        </div>
                        <a href="#opcion3-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-vial"></i> Pruebas</a>
                        <div id="opcion3-submenu" class="collapse">
                            <router-link to="/registrarcliente"
                                class="list-group-item list-group-item-action bg-secondary text-light">Registrar prueba
                            </router-link>
                            <router-link to="/listarclientes"
                                class="list-group-item list-group-item-action bg-secondary text-light">Listar pruebas
                            </router-link>
                        </div>
                        <a href="#opcion4-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-users-cog"></i> Empleados</a>
                        <div id="opcion4-submenu" class="collapse">
                            <router-link to="/registrarcliente"
                                class="list-group-item list-group-item-action bg-secondary text-light">Registrar empleado
                            </router-link>
                            <router-link to="/listarclientes"
                                class="list-group-item list-group-item-action bg-secondary text-light">Listar empleados
                            </router-link>
                        </div>
                        <a href="#opcion5-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-hospital"></i> Hospitalización</a>
                            <a href="#opcion6-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-procedures"></i> Cirujías</a>
                            <a href="#opcion7-submenu" class="list-group-item list-group-item-action bg-dark text-light"
                            data-toggle="collapse"><i class="fas fa-shopping-cart"></i> Productos</a>
                     </div>
                </div>
        
            </div>
        </div>

        <div class="col-md-10">
            <div id="page-content-wrapper" class="complemento">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
         </div>
    </div>

@endsection

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