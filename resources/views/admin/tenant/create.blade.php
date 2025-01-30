@extends('admin.layouts.app')
@section('content')



<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create Tenant</h3>
            </div>         
            <form action="{{route('tenant.store')}}" method="POST">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name"  placeholder="Enter Name">
                  @error('name')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">Email</label>
                  <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Email" name="email">
                  @error('email')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div> 
                <div class="form-group">
                  <label for="description">Domain Name</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Domain Name" name="domain_name">
                  @error('domain_name')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div> 
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control"  placeholder="Enter Password" name="password">
                  @error('password')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div> 
                <div class="form-group">
                  <label for="password">Confirm Password</label>
                  <input type="password" class="form-control"  placeholder="Enter Confirm Password" name="password_confirmation">
                  @error('password')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>            
               
              </div>
              @if (session('success'))
    {{-- <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
        });
    </script> --}}
@endif

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>   
  </section>
  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'asdfasdf asdf',
        timer: 3000,
        showConfirmButton: false,
    });
</script> --}}
@endsection
