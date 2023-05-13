@extends('layouts.app')

@section('title', 'Register')

@section('contenido')

    <div class="container">
        <h1>Registro</h1>

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
            <input class="form-control" type="password" placeholder="password_confirmation" id="password_confirmation"
                name="password_confirmation">

            <button class="btn btn-primary" type="submit">Enviar</button>

        </form>

    </div>

@endsection
