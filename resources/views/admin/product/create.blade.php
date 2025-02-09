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
                                <label for="regular_price">Regular Price</label>
                                <input type="text" class="form-control" name="regular_price" placeholder="Enter Regular Price">
                                @error('regular_price')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input type="text" class="form-control" name="sale_price" placeholder="Enter Sale Price">
                                @error('sale_price')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sku">SKU</label>
                                <input type="text" class="form-control" name="sku" placeholder="Enter SKU">
                                @error('sku')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock_status">Stock Status</label>
                                <select class="form-control" name="stock_status">
                                    <option value="instock">In Stock</option>
                                    <option value="outofstock">Out of Stock</option>

                                </select>
                                @error('stock_status')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Categories</label>
                                <select name="category_ids[]" class="form-control select-category" multiple="multiple">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_ids')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select id="brand-select" class="form-control select-brand" name="brand_id">
                                    <option disabled selected>Select Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Tags</label>
                                <select name="tags_ids[]" class="form-control select-tag" multiple="multiple">
                                    @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tags_ids')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="">
                                @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control" name="short_description" id="short_description" rows="4" style="height:500px" placeholder="Enter short description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter full description"></textarea>
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
                                    @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <img id="imageShow" src="" alt="Selected Image" class="img-thumbnail" style="display: none; width: 100px; height:100px" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="images">Additional Images</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="images[]" id="images" multiple>
                                    <label class="custom-file-label" for="images">Choose files</label>
                                    @error('images')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div id="imagePreview" class="mt-2"></div>
                        </div>
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



    document.querySelector('#images').addEventListener('change', function(event) {
        const fileList = event.target.files;
        const previewContainer = document.querySelector('#imagePreview');

        previewContainer.innerHTML = '';

        for (let i = 0; i < fileList.length; i++) {
            const file = fileList[i];

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.marginRight = '10px';
                    img.style.marginBottom = '10px';
                    img.classList.add('img-thumbnail');
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
    });

    $(document).ready(function() {
        $('.select-category').select2({
            placeholder: "Select Category"
            , allowClear: true
            , width: '100%'
        });
        $('.select-brand').select2({
            placeholder: "Select Brand"
            , allowClear: true
            , width: '100%'
        });
        $('.select-tag').select2({
            placeholder: "Select Tag"
            , allowClear: true
            , width: '100%'
        });
    });


    // Initialize CKEditor on the textareas
    ClassicEditor
        .create(document.querySelector('#short_description'))
        .catch(error => {
            console.error(error);
        });


    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

</script>



@endsection
