@extends('galeria_imagenes.common.principal')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-4 mt-5">
    <div class="card mb-4">
        <div class="card-body">
            @include('galeria_imagenes.usuario.configuracion.update-profile-information-form')
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            @include('galeria_imagenes.usuario.configuracion.update-password-form')
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            @include('galeria_imagenes.usuario.configuracion.delete-user-form')
        </div>
    </div>
</div>
@endsection