<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'image_profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relacion entre Usuario e Imagen
    public function imagenes(): HasMany
    {
        return $this->hasMany(Image::class, 'usuario_id');
    }

    // Relacion entre Usuario y Galeria
    public function galerias(): HasMany
    {
        return $this->hasMany(Galery::class, 'usuario_id');
    }

    // Relacion entre Usuario y Comentario
    public function comentarios(): HasMany
    {
        return $this->hasMany(CommentImage::class);
    }

    //  Funcion para recuperar las imagenes del usuario logeado en orden de creacion
    public function imagenesOrdenadas()
    {
        return $this->imagenes()->orderBy('created_at', 'asc')->get();
    }

    //  Funcion para recuperar las imagenes del usuario logeado en orden de creacion
    public function galeriasOrdenadas()
    {
        return $this->galerias()->orderBy('created_at', 'asc')->get();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
