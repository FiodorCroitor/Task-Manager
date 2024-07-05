<?php

namespace App\Data\Category;

/**
 * @property string $id
 * @property string $name
 * @property string $status
 */
class CategoryData
{

    public function __construct(
        public readonly string $name,
        public readonly string $status,

    )
    {
    }
}
