<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('galeria_imagenes.usuario.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('image_profile')) {
            // Esto es para eliminar la anterior imagen del ususario, asi q¡no la tengo en vano
            if ($user->image_profile && Storage::disk('public')->exists($user->image_profile)) {
                Storage::disk('public')->delete($user->image_profile);
            }
            // Aqui guardare la nueva imagen despues de eliminar la anterior del usuario
            $imagePath = $request->file('image_profile')->store('image_profiles', 'public');
            $user->image_profile = $imagePath;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('galeria_imagenes.usuario.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        // Eliminar la imagen de perfil si existe
        if ($user->image_profile && Storage::disk('public')->exists($user->image_profile)) {
            Storage::disk('public')->delete($user->image_profile);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
