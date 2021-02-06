<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class User_speciality extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'speciality_id';

    public function services() {
        return $this->hasMany(Service::class);
    }

    public function getServices() {
        return Service::where('service_id', $this->service_id)->get();
    }
}
