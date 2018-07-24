<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingOrders extends Model
{
    protected $fillable = ['order_path', 'order_price', 'name', 'phone', 'pending', 'created_at'];
}
