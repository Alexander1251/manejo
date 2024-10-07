<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class facturasController extends Controller
{
    public function index(){

        

        return view('facturas.index');

    }
}
