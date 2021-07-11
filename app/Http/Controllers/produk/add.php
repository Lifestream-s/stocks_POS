<?php

namespace App\Http\Controllers\produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class add extends Controller
{
    //
    public function index(){
        return View('produk.add');
    }
}
