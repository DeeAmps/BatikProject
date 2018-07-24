<?php

namespace App\Http\Controllers;

use App\PendingOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class ApiController extends Controller
{
    public function OrderCompleted(Request $request){
        if($request["Crypt"] == $this->Crypt($request["timeStamp"])){
            $phoneNumber = "0" . $request["phoneNumber"];
            $pendingOrders = (new PendingOrders())->getTable();
            DB::table($pendingOrders)->where("phone", "=", $phoneNumber)->update(array("pending" => 0));
            //PendingOrders::where("phone", "=", $phoneNumber)->update(['pending', 0]);
            if(PendingOrders::where("phone", "=", $phoneNumber)->first()){
                return response()->json(["success"=> true, "phone" => $phoneNumber], 200);
            }
            else{
                return response()->json(["success"=> false, "phone" => $phoneNumber], 500);
            }
        }
        else{
            return response()->json(["success"=> false, 401]);
        }
    }

    private function Crypt($timeStamp){
        $tm = $timeStamp + 20 + 585 + 2014;
        return hash("sha512", (string)$tm);
    }
}
