<?php

namespace App;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'user_role_id';

    public function roles() {
        return $this->hasMany(Role::class);
    }

    public function getRoles() {
        return Role::where('role_id', $this->role_id)->get();
    }
}
