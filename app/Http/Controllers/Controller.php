<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkout() {
        // dd('checkout page here');
        return view('checkout');
    }
    public function checkoutsubmit(Request $request) {
        // dd('checkout page here');
        dd($request->all());
        // return view('checkout');
    }
}
