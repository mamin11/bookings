<?php

namespace App;

use App\Order_detail;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public $timestamps = true;
    protected $primaryKey = 'order_id';

    public function getOrderDetails() {
        return Order_detail::where('order_id', $this->order_id)->get();
    }
}
