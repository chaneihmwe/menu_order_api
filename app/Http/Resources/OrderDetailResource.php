<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Menu;
use App\User;
use App\Http\Resources\MenuResource;
use App\UserDetail;
use App\Http\Resources\OrderDetailResource;
class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'id' => $this->id,
            'voucher_no' => $this->voucher_no,
            'menu' => new MenuResource(Menu::find($this->menu_id)),
            'qty' => $this->qty,
            'total_price' => $this->total_price,
            'user_id' => new UserResource(User::find($this->user_id)),  
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
