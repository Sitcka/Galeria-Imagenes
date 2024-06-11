@extends('layouts.autenticacion')
@section('title', 'Recuperar')
@section('content')
<div class="mb-4 text-sm text-muted">
    {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente déjanos saber tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.') }}
</div>

<!-- Session Status -->
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <!-- Correo electronico -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Fin de correo electronico -->
    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Enviar') }}
        </button>
    </div>
</form>
@endsection