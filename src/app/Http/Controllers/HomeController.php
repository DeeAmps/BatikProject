<?php

namespace App\Http\Controllers;

use App\onSale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $images = onSale::all();
        $data = array("images" => $images)["images"];
        //return response()->json($data, 200);
        return view("home", compact("data"));

    }
}
