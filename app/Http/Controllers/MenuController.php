<?php

namespace App\Http\Controllers;

use App\Menu;
use App\SubCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus=Menu::all();
        return view('backend.menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = SubCategory::all();
        return view('backend.menu.create',compact('sub_categories'));
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
            "sub_category_id" => 'required',
            "name" => 'required | min:3',
            "price" => 'required | min:3'
        ]);

        $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/image'),$name);
            $path='storage/image/'.$name;
        }
        else{
            $path = null;
        }
        //store data 
        $menu = new Menu;
        $menu->sub_category_id = request('sub_category_id');
        $menu->name = request('name');
        $menu->price = request('price');
        $menu->image = $path;
        $menu->save();

        return redirect()->route('admin.menu.index')->with('status','Successfully');
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
         $menu = Menu::find($id);
         $sub_categories = SubCategory::all();
        return view('backend.menu.edit', compact('menu', 'sub_categories'));
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
            "sub_category_id" => 'required',
            "name" => 'required | min:3',
            "price" => 'required | min:3'
        ]);
        $image = $request->file('image');
        if($image){
            $name=uniqid().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/image'),$name);
            $path='storage/image/'.$name;
        }
        else{
            $path = request('old_image');
        }
        $menu = Menu::find($id);
        $menu->sub_category_id = request('sub_category_id');
        $menu->name = request('name');
        $menu->price = request('price');
        $menu->image = $path;
        $menu->save();
    return redirect()->route('admin.menu.index');
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
        return redirect()->route('admin.menu.index');
    }
}