@extends('admin.layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Brand</h3>
                    <a class="float-right" href="{{ route('brand.index') }}"><i class="fas fa-list"></i></a>

                </div>
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image" onchange="previewImage(event)">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <img id="imagePreview" src="" alt="Selected Image" class="img-thumbnail" style="display: none; max-width: 100px; height:100px"/>
                            </div>
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
            const fileLabel = input.nextElementSibling; // The label next to the input
            const imagePreview = document.getElementById("imagePreview");
    
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block"; // Show image
                };
                
                reader.readAsDataURL(input.files[0]);
                
                // Update file name in the label
                fileLabel.textContent = input.files[0].name;
            }
        }
    </script>
    
@endsection
