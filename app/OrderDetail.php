<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $fillable = ['menu_id','voucher_no','qty'];
}
