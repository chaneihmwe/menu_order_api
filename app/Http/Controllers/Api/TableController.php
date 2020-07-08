<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Table;
use App\Http\Resources\TableResource;
class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tables = Table::all();
        $tables =  TableResource::collection($tables);
        return response()->json([
            'tables' => $tables,
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
        //
         $request->validate([
            "table_no" => "required|min:3|max:20",
        ]);
        $table = Table::create([
            "table_no" => request('table_no') ,
             ]);

        $table = new TableResource($table);

        return response()->json([
            'table'  =>  $table,
            'message'   =>  'Successfully Table Added!'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //echo "$request";die();
        $request->validate([
            "table_no" => "required|min:3|max:255",
        ]);
        $table= Table::find($id);
        $table->table_no=$request->table_no;
        $table->save();

        return response()->json([
            'message'   =>  'Successfully Table updated!!'
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
        $table = Table::find($id);
        $table->delete();

        return response()->json([
            'message'   =>  'Successfully Table deleted!!'
        ],200);
    }
    public function getMenuByCategory(Request $request)
    {
        $category_id = $request->category_id;
        return $category_id;
    }
}
