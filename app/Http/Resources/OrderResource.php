<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Table;
use App\User;
class OrderResource extends JsonResource
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
            'user_id' => new UserResource(User::find($this->user_id)),  
            'table' => new TableResource(Table::find($this->table_id)),
            'total_price' => $this->total_price,  
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
