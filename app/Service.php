<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'service_id';

}
