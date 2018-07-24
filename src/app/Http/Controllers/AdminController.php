<?php

namespace App\Http\Controllers;

use App\PendingOrders;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = PendingOrders::all()->where("pending", "=", "1")->groupBy("phone");
        return view('admin', compact("orders"));
    }

}
