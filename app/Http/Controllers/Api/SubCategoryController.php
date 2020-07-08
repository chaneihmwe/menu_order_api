<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use App\Http\Resources\SubCategoryResource;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sub_categories = SubCategory::all();
        $sub_categories =  SubCategoryResource::collection($sub_categories);
        return response()->json([
            'subCategories' => $sub_categories,
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
            "name" => "required|min:3|max:20",
            "category_id" => "required|min:1",
        ]);
        $sub_category = SubCategory::create([
            "name" => request('name') ,
            "category_id" => request('category_id'),
             ]);

        $sub_category = new SubCategoryResource($sub_category);

        return response()->json([
            'subCategory'  =>  $sub_category,
            'message'   =>  'Successfully Sub Category Added!'
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
            "name" => "required|min:3|max:20",
            "category_id" => "required|min:1",
        ]);
        $sub_category= SubCategory::find($id);
        $sub_category->name=$request->name;
        $sub_category->category_id=request('category_id');;
        $sub_category->save();

        return response()->json([
            'message'   =>  'Successfully Sub Category updated!!'
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
        $sub_category = SubCategory::find($id);
        $sub_category->delete();

        return response()->json([
            'message'   =>  'Successfully Sub Category deleted!!'
        ],200);
    }
    public function getMenuByCategory(Request $request)
    {
        $category_id = $request->category_id;
        return $category_id;
    }
}
