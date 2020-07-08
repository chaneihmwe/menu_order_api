@extends('backend.backend_template')
@section('content')
<!--Nav Bar-->
<div class="container">
    <div class="row">
        <div class="col">
          <h1>Table</h1>
        </div>
        
        <div class="col col-lg-3">
            <a href="{{route('admin.table.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Table</a>
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
              <th scope="col">Table No</th>
              <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach($tables as $key => $row)
          <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $row->table_no }}</td>
            <td>
                
                    <form method="post" action="{{ route('admin.table.destroy', $row->id)}}"  onsubmit="return confirm('Are you sure')">
                      <a href="{{ route('admin.table.edit',$row->id)}}" class="btn btn-primary">Edit</a>
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