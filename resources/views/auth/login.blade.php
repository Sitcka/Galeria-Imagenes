@extends('layouts.autenticacion')
@section('content')
<!-- Session Status -->
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Correo electronico del login -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Correo Electronico') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Fin de correo electronico del login -->

    <!-- Contraseña del login  -->
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Fin de contraseña del login -->

    <!-- Recordar la contraseña -->
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">{{ __('Recuerdame') }}</label>
    </div>
    <!-- Fin de recuerdame del login -->

    <!-- Olvidar la contraseña -->
    <div class="d-flex justify-content-between align-items-center">
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('¿Olvidaste tu contraseña?') }}
        </a>
        @endif

        <button type="submit" class="btn btn-primary">
            {{ __('Entrar') }}
        </button>
    </div>
    <!-- Fin de olvidar contraseña -->
</form>
@endsection