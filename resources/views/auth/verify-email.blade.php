@extends('layouts.autenticacion') <!-- Cambia esto según el layout que estés usando -->
@section('content')

    
    <div class="card-header">{{ __('Verifica tu dirección de correo electrónico') }}</div>

    <div class="card-body">
        <div class="mb-4 text-sm text-muted">
            {{ __('Gracias por registrarte! Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar. Si no recibiste el correo electrónico, te enviaremos otro con mucho gusto.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
        </div>
        @endif

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('Reenviar correo de verificación') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ligth">
                    {{ __('Cerrar sesión') }}
                </button>
            </form>
        </div>
    </div>

@endsection