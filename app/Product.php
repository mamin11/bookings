<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'product_id';

    public function getTotalPrice() {
        //sum of flat price, material, category and size

    }

    public function getMaterial() {

    }

    public function getSize() {

    }

    public function getCategory() {

    }

    public function getMainImage() {
        //thumbnail image
        
    }

    public function getImages() {
        //carousel images

    }
}
