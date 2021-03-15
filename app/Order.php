<?php

namespace App;

use App\User;
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

    public function getTotalItems() {
        $orderItems = Order_detail::where('order_id', $this->order_id)->get();
        $count = 0;
        foreach ($orderItems as $item) {
            $count += $item->product_quantity;
        }
        return $count;
    }

    public function getCustomer() {
        return User::where('user_id', $this->customer_id)->first();
    }

}
