<?php

namespace App\Models;

use App\Casts\MoneyCasts;
use App\Enums\ProductStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Routing\Exceptions\BackedEnumCaseNotFoundException;
use Illuminate\Support\Collection;

class Payout extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'product_id',
            'price',
            'status'
        ];

    protected $casts = [
      'price'  => MoneyCasts::class,
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
