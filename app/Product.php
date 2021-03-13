<?php

namespace App;

use App\Product_size;
use App\Product_image;
use App\Product_category;
use App\Product_material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'product_id';

    public function getTotalPrice() {
        //sum of flat price, material, category and size
        return ($this->price + $this->getCategory()->extra_cost + $this->getSize()->extra_price_on_product + $this->getMaterial()->extra_price_on_product);

    }

    public function getShippingCost() {
        return ($this->getCategory()->extra_cost + $this->getSize()->extra_price_on_product + $this->getMaterial()->extra_price_on_product);
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
        $images = Product_image::where('product_id', $this->product_id)->get();
        $allImgs = [];

        foreach ($images as $img) {
            if($img->is_main === 0) {
                return Storage::disk('s3')->url('products/'.$img->name);
            }
        }
        

    }

    public function getImages() {
        $images = Product_image::where('product_id', $this->product_id)->get();
        $allImgs = [];

        foreach ($images as $img) {
            $allImgs[] = Storage::disk('s3')->url('products/'.$img->name);
        }

        return $allImgs;

    }
}
