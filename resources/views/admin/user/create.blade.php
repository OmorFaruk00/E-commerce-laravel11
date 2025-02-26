@extends('admin.layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create User</h3>
                    <a class="float-right" href="{{ route('user.index') }}"><i class="fas fa-list"></i></a>

                </div>
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter email"
                                        name="email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control"  placeholder="Enter Password" name="password">
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                  </div> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control"  placeholder="Enter Confirm Password" name="password_confirmation">
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                  </div>   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="brand_id">Role</label>
                                    <select id="role-select" class="form-control select-role" name="role_id">
                                        <option disabled selected>Select Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control"  placeholder="Enter Phone Number"
                                        name="phone">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>                      
                      
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" onchange="previewImage(event)">
                            <label class="custom-file-label">Choose file</label>
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <img id="imageShow" src="" alt="Selected Image" class="img-thumbnail" style="display: none; width: 100px; height:100px" />
                        </div>

                    </div>                

                    <div class="card-footer ">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function previewImage(event) {
            const input = event.target;
            const fileLabel = input.nextElementSibling;
            const imagePreview = document.getElementById("imageShow");
    
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };
                reader.readAsDataURL(input.files[0]);
                fileLabel.textContent = input.files[0].name;
            }
        }

        $(document).ready(function() {
        $('.select-role').select2({
            placeholder: "Select Category"
            , allowClear: true
            , width: '100%'
        });
     
    });
    
    
    
        
       
    
    
  
    
    
      
    
    </script>
@endsection
