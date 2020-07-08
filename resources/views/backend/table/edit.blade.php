@extends('backend.backend_template')
@section('content')
<!--Nav Bar-->
<div class="container">
    <div class="row">
        <div class="col">
          <h2>Edit Table</h2>
        </div>
        
        <div class="col col-lg-2">
            <a href="{{route('admin.table.index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Table List</a>
        </div>
      
    </div>
</div>

<div class="container mt-3 ">
  <div class="row">
    <div class="col-lg-6 offset-3 p-3 card">
      <form method="post" action="{{ route('admin.table.update', $table->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <input type="text" name="table_no" value="{{ $table->table_no }}" class="form-control">

          
        </div>
        <input type="submit" name="" value="Update" class="btn btn-primary float-right">
        
      </form>
      
    </div>
    
  </div>
  
</div>


@endsection