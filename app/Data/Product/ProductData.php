<?php

namespace App\Data\Product;

/**
 * @property string $name
 * @property string $description
 * @property int $category
 * @property float $price
 * @property string $status_id
 * @property array $attachments
 */
class ProductData
{
    public function __construct(
        public readonly string  $name,
        public readonly ?string $description,
        public readonly string  $status,
        public readonly string  $category_id,
        public readonly ?array  $attachments,

    )
    {
    }
}
