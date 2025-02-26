@extends('admin.layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Category</h3>
                    <a class="float-right" href="{{ route('category.index') }}"><i class="fas fa-list"></i></a>

                </div>
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter slug"
                                name="slug">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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

                    <div class="card-footer">
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
    
    
    
        
       
    
    
  
    
    
      
    
    </script>
@endsection
