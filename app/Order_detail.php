<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'order_details_id';

    public function getProduct() {
        return Product::where('product_id', $this->product_id);
    }

}
