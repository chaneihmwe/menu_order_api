@extends('backend.backend_template')
@section('content')
<!--Nav Bar-->
<div class="container">
    <div class="row">
        <div class="col">
          <h1>SubCategory</h1>
        </div>
        
        <div class="col col-lg-3">
            <a href="{{route('admin.menu.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Sub Category</a>
        </div>
      
    </div>
</div>

<div class="container mt-3">
    <div class="row">
      @if (session('status'))
          <div class="alert alert-success col-md-6 offset-3">
              {{ session('status') }}
          </div>
        @endif
        <div class="col-md-12 p-3 card">
          <table class="table  align-items-center table-white" id="myTable">
        
        
        <thead>
          <tr>
              <th scope="col">No.</th>
              <th scope="col">Menu Name</th>
              <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach($menus as $key => $row)
          <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $row->name }}</td>
            <td>
                
                    <form method="post" action="{{ route('admin.menu.destroy', $row->id)}}"  onsubmit="return confirm('Are you sure')">
                      <a href="{{ route('admin.menu.edit',$row->id)}}" class="btn btn-primary">Edit</a>
                      @csrf
                      @method('DELETE')
                      <input type="submit" class="btn btn-outline-primary" value="Delete">
                    </form>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
        </div>
    </div>  
  </div>  


@endsection