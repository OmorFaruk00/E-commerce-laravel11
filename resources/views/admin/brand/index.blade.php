@extends('admin.layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class=" col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Brand Data</h3>
            <a href="{{ route('brand.create') }}" class="btn btn-primary float-right">Add Brand</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $index => $item)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td> <img src="{{ asset($item->image) }}" alt="Image" width="60" height="60"></td>
                    </td>
                    <td>
                      <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-sm btn-info mr-3 mb-2"><i
                          class="fas fa-edit"></i></a>
                      <form action="{{ route('brand.destroy', $item->id) }}" method="POST" style="display:inline;"
                        onsubmit="return confirm('Are you sure you want to delete this Brand?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger mb-2" title="Delete">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
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
  </div>
</section>
@endsection