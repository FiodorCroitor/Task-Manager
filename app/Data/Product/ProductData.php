<?php

namespace App\Data\Product;

/**
 * @property string $name
 * @property string $description
 * @property int $category
 * @property float $price
 * @property string $status
 */
class ProductData
{
    public string $name;
    public string $description;
    public int $category_id;
    public float $price;
    public string $status;
   public function __construct(
       string $name,
       string $description,
       int    $category_id,
       float  $price,
       string $status
   )
   {
       $this->name = $name;
       $this->description = $description;
       $this->category = $category_id;
       $this->price = $price;
       $this->status = $status;
   }
}
