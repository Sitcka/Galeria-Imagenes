@extends('layouts.autenticacion')
@section('title', 'Registro')
@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Crear nombre -->
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Nombre') }}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Fin de crear nombre -->

    <!-- Crear correo electronico -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Correo Electronico') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Fin de crear correo electronico -->

    <!-- Crear contraseña -->
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Fin de crear contraseña -->

    <!-- Confirmar Contraseña -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Fin de Confirmar Contraseña -->

    <!-- Confirmar registro -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a class="btn btn-link" href="{{ route('login') }}">
            {{ __('¿Ya estás registrado?') }}
        </a>
        <button type="submit" class="btn btn-primary">
            {{ __('Registrarse') }}
        </button>
    </div>
    <!-- Fin de Confirmar registro -->
</form>
@endsection