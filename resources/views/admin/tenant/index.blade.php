@extends('admin.layouts.app')
@section('content')



<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tenant Data </h3>
              <a class="btn btn-primary float-right" href="{{route('tenant.create')}}"> Add Tenant</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $index=>$item)
                <tr>
                  <td>{{ $index +1}}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  </td>
                </tr>
                @endforeach          
            
                </tbody>            
              </table>
            </div>          
          </div>       
        </div>    
      </div>    
    </div>   
  </section>
@endsection