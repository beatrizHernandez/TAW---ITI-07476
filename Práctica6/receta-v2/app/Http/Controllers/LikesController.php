<?php

namespace App\Http\Controllers;

use App\Receta2;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, Receta2 $receta)
    {
        return auth()->user()->meGusta()->toggle($receta);
    }
}
