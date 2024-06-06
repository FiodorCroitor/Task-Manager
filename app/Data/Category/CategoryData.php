<?php

namespace App\Data\Category;

/**
 * @property string $name
 */
class CategoryData
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
