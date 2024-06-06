<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'category',
            'description',
            'price',
        ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
