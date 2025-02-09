@extends('admin.layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Product</h3>
                    <a class="float-right" href="{{ route('product.index') }}"><i class="fas fa-list"></i></a>
                </div>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" placeholder="Enter slug" name="slug">
                                    @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea class="form-control" name="short_description" rows="2" placeholder="Enter short description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="2" placeholder="Enter full description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="regular_price">Regular Price</label>
                                    <input type="text" class="form-control" name="regular_price" placeholder="Enter Regular Price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sale_price">Sale Price</label>
                                    <input type="text" class="form-control" name="sale_price" placeholder="Enter Sale Price">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sku">SKU</label>
                                    <input type="text" class="form-control" name="sku" placeholder="Enter SKU">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock_status">Stock Status</label>
                                    <select class="form-control" name="stock_status">
                                        <option value="instock">In Stock</option>
                                        <option value="outofstock">Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Categories</label>
                                    <select name="category_ids[]" class="form-control select2" multiple="multiple">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                
                                
                                <div class="form-group">
                                    <label for="brand_id">Brand</label>
                                    <select class="form-control" name="brand_id">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" value="10">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" onchange="previewImage(event)">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="" alt="Selected Image" class="img-thumbnail" style="display: none; max-width: 100px; height:100px"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="images">Additional Images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="images[]" multiple>
                                        <label class="custom-file-label">Choose files</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="featured" value="1">
                            <label class="form-check-label">Featured Product</label>
                        </div>

                    </div>                

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Save</button>
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
   <script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Categories",
            allowClear: true,
            width: '100%'
        });
    });
</script>

    
    
@endsection
