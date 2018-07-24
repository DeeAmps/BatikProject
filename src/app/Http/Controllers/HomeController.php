<?php

namespace App\Http\Controllers;

use App\onSale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = onSale::all();
        $data = array("images" => $images)["images"];
        //return response()->json($data, 200);
        return view("home", compact("data"));
    }

    public function contact(){
        return view("contact");
    }

    public function cart(){
        return view("cart");
    }

    public function checkout(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|max:10'
        ]);
        return response()->json($request);
    }
}
