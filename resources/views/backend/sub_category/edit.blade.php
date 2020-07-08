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
      <form method="post" action="{{ route('admin.sub_category.update', $sub_category->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
              <label> Category Type</label>
              <select class="form-control" name="category_id">
                @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select>
              </div>
        <div class="form-group">
          <label> Sub Category Name</label>
          <input type="text" name="name" value="{{ $sub_category->name }}" class="form-control">
        </div>
        <input type="submit" name="" value="Update" class="btn btn-primary float-right">
        
      </form>
      
    </div>
    
  </div>
  
</div>


@endsection