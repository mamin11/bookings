<?php

namespace App;

use App\Product_size;
use App\Product_category;
use App\Product_material;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'product_id';

    public function getTotalPrice() {
        //sum of flat price, material, category and size

    }

    public function getMaterial() {
        return Product_material::where('material_id', $this->material_id)->first();
    }

    public function getSize() {
        return Product_size::where('size_id', $this->size_id)->first();
    }

    public function getCategory() {
        return Product_category::where('category_id', $this->category_id)->first();
    }

    public function getMainImage() {
        //thumbnail image

    }

    public function getImages() {
        //carousel images

    }
}
