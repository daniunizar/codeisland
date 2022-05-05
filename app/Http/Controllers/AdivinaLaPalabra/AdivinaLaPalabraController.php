<?php

namespace App\Http\Controllers\AdivinaLaPalabra;

use Illuminate\Http\Request;
use App\Models\AdivinaLaPalabra\AdivinaLaPalabra;
use App\Http\Controllers\Controller;
class AdivinaLaPalabraController extends Controller
{
    public function index(){
        return view('adivina-la-palabra.index');
    }
}
