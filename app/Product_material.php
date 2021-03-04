<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_material extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'material_id';
}
