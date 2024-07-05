<?php

namespace App\Models;

use App\Enums\ProductStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable =
        [
            'name',
            'category_id',
            'description',
            'price',
            'status',
        ];

    protected $casts = [
        'status' => ProductStatuses::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function getProductStatus()
    {
        return ProductStatuses::from($this->status);
    }




}
