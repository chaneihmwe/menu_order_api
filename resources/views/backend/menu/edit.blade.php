@extends('backend.backend_template')
@section('content')
<!--Nav Bar-->
<div class="container">
    <div class="row">
        <div class="col">
          <h2>Edit Category Name</h2>
        </div>
        
        <div class="col col-lg-2">
            <a href="" class="btn btn-primary"><i class="fas fa-plus"></i> Category List</a>
        </div>
      
    </div>
</div>

<div class="container mt-3 ">
  <div class="row">
    <div class="col-lg-6 offset-3 p-3 card">
      <form method="post" action="{{ route('admin.menu.update', $menu->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
              <label> Category Type</label>
              <select class="form-control" name="sub_category_id">
                @foreach($sub_categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select>
              </div>
            <div class="form-group mt-3">
              <label>Menu Name</label>
              <input type="text" name="name" class="form-control" value="{{$menu->name}}">
            </div>

            <div class="form-group mt-3">
              <label>Price</label>
              <input type="text" name="price" class="form-control" value="{{$menu->price}}">
            </div>

            <div class="form-group mt-3">
              <label>Menu Image</label>
              <input type="file" name="image" class="form-control">
              <img src="{{asset($menu->image)}}" style="width: 70px; height: 70px" class="img-fluid mt-3">
              <input type="hidden" name="old_image" value="{{$menu->image}}">
            </div>
            
            <button type="submit" class="btn btn-primary float-right">Add Category</button>
        
      </form>
      
    </div>
    
  </div>
  
</div>


@endsection