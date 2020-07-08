<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDetail;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MenuResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailResource;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        $orders =  OrderResource::collection($orders);
        return response()->json([
            'orders' => $orders,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          "user_id" => "required",
          "table_id" => "required",
          "total_price" => "required|min:4|max:255",
        ]);
        $mytime = Carbon::now();
        $day = $mytime->day;
        $month = $mytime->month;
        $year = $mytime->year;
        $date = $day.$month.$year;
      
         

            $orders = Order::all();
            //return $orders;
            if ($orders == '[]') {
                $voucher_no = $date.'0001';
            }else{
                foreach ($orders as $order) {
                    $voucher_no = $order->voucher_no;
                }
                 //echo $voucher_no.'</br>'; 
                $current = Str::substr($voucher_no,0,6); 
                if ($date == $current) {
                      ++$voucher_no; 
                  }
            }

        //   return $voucher_no;
        
            
        
        $orders = Order::create([
            'voucher_no'      => $voucher_no,
            'user_id'   => request('user_id'),
            'table_id'   => request('table_id'),
            'total_price'=> request('total_price'),
        ]);
      
        $order_details = array(
            array("1","2","20000"),
            array("2","2","40000")
        );
        
        foreach ($order_details as $order_detail) {
                OrderDetail::create([
                'voucher_no'  => $voucher_no,
                'menu_id'   => $order_detail[0],
                'qty'  => $order_detail[1],
            ]);
                }
        return response()->json([
            'orders'  =>  $orders,
            'message'   =>  'Successfully Order Added!'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($voucher_no)
    {
        //
        $orders = DB::table('orders')
            ->join('order_details', 'order_details.voucher_no', '=', 'orders.voucher_no')
            ->select('orders.*', 'order_details.id as order_detail_id', 'order_details.menu_id as menu_id', 'order_details.qty as qty')
            ->where('orders.voucher_no','=',$voucher_no)
            ->get();
        $order_detail =  OrderDetailResource::collection($orders);

        return response()->json([
            'order_detail' => $order_detail,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);
        $order->status = 0;
        return response()->json([
            'message'   =>  'Successfully Order Checkout!!'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
