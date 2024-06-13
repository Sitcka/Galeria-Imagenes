<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informacion del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualiza el nombre y correo electrónico de tu cuenta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('galeria_imagenes.usuario.configuracion.update') }}" enctype="multipart/form-data" class="mt-4" id="profileForm">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="image_profile" class="form-label">{{ __('Foto de Perfil') }}</label>
            <div class="m-3">
                <img src="{{ $user->image_profile ? asset('storage/' . $user->image_profile) : asset('storage/image_profiles/defecto_usuario.png') }}" alt="Imagen de Perfil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <input id="image_profile" name="image_profile" type="file" class="form-control @error('image_profile') is-invalid @enderror" accept="image/*">
            @error('image_profile')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('E-mail') }}</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-sm text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to re-send the verification email.') }}</button>
                </p>
                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-success">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
            @if (session('status') === 'profile-updated')
            <p class="ms-3 text-sm text-success">
                {{ __('Guardado.') }}
            </p>
            @endif
        </div>
    </form>
</section>
@vite('resources/js/validacionEditUser.js')
