<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'path', 'usuario_id'];
    // Relacion entre Imagen y Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relacion entre Imagen y Comentario
    public function comentarios(): HasMany
    {
        return $this->hasMany(CommentImage::class, 'imagen_id')->with('usuario');
    }

    // Relacion entre Imagen y Galeria
    public function galerias(): BelongsToMany
    {
        return $this->belongsToMany(Galery::class, 'galery_image', 'image_id', 'galery_id')
            ->withTimestamps();
    }

    // Todos los comentarios
    public function comentariosImagen()
    {
        return $this->comentarios()->orderBy('created_at', 'asc')->get();
    }
}
