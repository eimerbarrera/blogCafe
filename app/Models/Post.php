<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'summary',
        'status',
        'featured_image',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * El método "booted" del modelo para manejar eventos.
     */
    protected static function booted(): void
    {
        // Se ejecuta antes de crear o actualizar el registro
        static::saving(function (Post $post) {
            // Si el título cambió o el slug está vacío, generamos el slug automáticamente
            if ($post->isDirty('title') || empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    // Un post pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Un post tiene muchos archivos multimedia asociados
    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    // Relación muchos a muchos con categorías
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    // Relación muchos a muchos con etiquetas
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
