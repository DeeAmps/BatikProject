<?php

namespace App\Http\Controllers;

use App\onSale;
use App\PendingOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

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
        $pending = new PendingOrders();
        $cart = get_object_vars(json_decode(($request["cart"])));
        foreach ($cart as $key=>$value){
            $pending->order_path = $key;
            $pending->order_price = $value;
            $pending->name = $request["name"];
            $pending->phone = $request["phone"];
            $pending->pending = 1;
            $pending->created_at = Carbon::now();
        }
        $pending->save();
        return redirect()->back()->with("status", "Your Order has been sent successfully!");

    }
}
