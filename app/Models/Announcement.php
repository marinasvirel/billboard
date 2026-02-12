<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Announcement extends Model
{
    /** @use HasFactory<\Database\Factories\AnnouncementFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'slug',
        'title',
        'text',
        'action',
        'is_publish',
    ];

    // Указываем Laravel искать записи по полю 'slug'
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Автоматическая генерация слага при сохранении
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($announcement) {
            $slug = Str::slug($announcement->title);
            $originalSlug = $slug;
            $count = 1;

            // Проверяем уникальность слага в цикле
            while (static::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $announcement->slug = $slug;
        });
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
