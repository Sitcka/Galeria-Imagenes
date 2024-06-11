<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galery extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'usuario_id'];

    // Relacion entre Galeria y Usuario
    public function usuario() : BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    // Relacion entre Galeria e Imagen
    public function imagenes(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'galery_image', 'galery_id', 'image_id')
            ->withTimestamps();
    }

    public function imagenesGaleria()
    {
        return $this->imagenes()->orderBy('created_at', 'asc')->get();
    }


}
