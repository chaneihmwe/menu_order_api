<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories=SubCategory::all();
        return view('backend.sub_category.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.sub_category.create',compact('categories'));
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
            "category_id" => 'required',
            "name" => 'required | min:3'
        ]);

        //store data 
        $categories = new SubCategory;
        $categories->category_id = request('category_id');
        $categories->name = request('name');
        $categories->save();

        return redirect()->route('admin.sub_category.index')->with('status','Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = SubCategory::find($id);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $sub_category = SubCategory::find($id);
         $categories = Category::all();
        return view('backend.sub_category.edit', compact('sub_category', 'categories'));
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
            "category_id" => 'required',
            "name" => 'required | min:3'
        ]);
        $categories = SubCategory::find($id);
        $categories->category_id = request('category_id');
        $categories->name = request('name');
        $categories->save();

    return redirect()->route('admin.sub_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = SubCategory::find($id);
        $categories->delete();
        return redirect()->route('admin.sub_category.index');
    }
}