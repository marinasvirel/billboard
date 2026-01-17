<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubcategoryFactory> */
    use HasFactory;

    protected $fillable = ['category_id', 'name'];

    //Обратная связь: подкатегория принадлежит определенной категории.
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    //Связь с объявлениями: у подкатегории может быть много объявлений.
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}
