@extends('backend.backend_template')
@section('content')
<!--Nav Bar-->
<div class="container">
    <div class="row">
        <div class="col">
          <h2>Create New Table</h2>
        </div>
        
        <div class="col col-lg-2">
            <a href="" class="btn btn-primary"><i class="fas fa-plus"></i> Table List</a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 card p-5">
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="post" action="{{ route('admin.table.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label> Table NO</label>
    <input type="number" name="table_no" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary float-right">Add Table</button>
</form>
        </div>
        
    </div>
    
</div>

@endsection