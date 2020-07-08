<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = ['sub_category_id','name','price','image'];
}
