<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product_image extends Model
{
    protected $guarded = [];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function getImage() {
        if($this->image) {
            return Storage::disk('s3')->url('products/'.$this->image);
        }
        return 'img/user-profile.png';
    }
}
