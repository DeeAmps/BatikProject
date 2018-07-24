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
        $cart = get_object_vars(json_decode(($request["cart"])));
        $orders = [];
        foreach($cart as $key=>$value){
              array_push($orders, array(
                    "order_path" => $key,
                    "order_price" => $value,
                    "name" => $request["name"],
                    "phone" => str_replace(' ', '', $request["phone"]),
                    "pending" => 1,
                    "created_at" => Carbon::now()
                ));
        }
        PendingOrders::insert($orders);
        return redirect()->back()->with("status", "Your Order has been sent successfully!");

    }
}
