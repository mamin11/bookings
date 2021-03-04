<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_size extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'size_id';
}
