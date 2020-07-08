<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['table_id','user_id','voucher_no','total_price', 'status'];
}
