<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentImage extends Model
{
    use HasFactory;

    protected $fillable = ['texto', 'usuario_id', 'imagen_id', 'created_at'];

    // Relacion entre Comentario y Usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacion entre Comentario e Imagen
    public function imagen(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'imagen_id');
    }
}
