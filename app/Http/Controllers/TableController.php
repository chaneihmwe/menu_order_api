<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables=Table::all();
        return view('backend.table.index',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::all();
        return view('backend.table.create');
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
            "table_no" => 'required | min:3'
        ]);

        //store data 
        $table = new Table;
        $table->table_no = request('table_no');
        $table->save();

        return redirect()->route('admin.table.index')->with('status','Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::find($id);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $table = Table::find($id);
        return view('backend.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "table_no" => 'required | min:3'
        ]);
        $table = Table::find($id);
        $table->table_no = request('table_no');
        $table->save();

    return redirect()->route('admin.table.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);
        $table->delete();
        return redirect()->route('admin.table.index');
    }
}