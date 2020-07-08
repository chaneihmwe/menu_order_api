<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use App\Category;
use App\Http\Resources\MenuResource;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menus = Menu::all();
        $menus =  MenuResource::collection($menus);
        return response()->json([
            'menus' => $menus,
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
            "sub_category_id" => "required|min:1",
            "price" => "required|min:3|max:20",
            "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:10000",
        ]);

         if($request->hasfile('image')){
                $image=$request->file('image');
                $name=$image->getClientOriginalName();
                $image->move(public_path().'storage/image/',$name);
                $image='storage/image/'.$name;
        }

        $menu = Menu::create([
            "name" => request('name') ,
            "sub_category_id" => request('sub_category_id'),
            "price" => request('price'),
            "image" => $image,
             ]);

        $menu = new MenuResource($menu);

        return response()->json([
            'menu'  =>  $menu,
            'message'   =>  'Successfully Menu Added!'
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
            "sub_category_id" => "required|min:1",
            "price" => "required|min:3|max:20",
        ]);

        if ($request->hasfile('image')){
            $image=$request->file('image');
            $name=$image->getClientOriginalName();
            $image->move(public_path().'storage/image/',$name);
            $image='storage/image/'.$name;
        }else{
            $image=request('old_image');
        }
        $menu= Menu::find($id);
        $menu->name=$request->name;
        $menu->sub_category_id=request('sub_category_id');;
        $menu->price=$request->price;
        $menu->image=$image;
        $menu->save();

        return response()->json([
            'message'   =>  'Successfully Menu updated!!'
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
        $menu = Menu::find($id);
        $menu->delete();

        return response()->json([
            'message'   =>  'Successfully Menu deleted!!'
        ],200);
    }
    public function getMenuByCategory(Request $request)
    {
        $category_id = $request->category_id;
        return $category_id;
    }
}
