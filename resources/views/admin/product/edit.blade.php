@extends('admin.layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
                <a class="float-right" href="{{ route('product.index') }}"><i class="fas fa-list"></i></a>
            </div>
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ $product->slug }}" placeholder="Enter Slug">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="regular_price">Regular Price</label>
                                <input type="text" class="form-control" name="regular_price" value="{{ $product->regular_price }}" placeholder="Enter Regular Price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input type="text" class="form-control" name="sale_price" value="{{ $product->sale_price }}" placeholder="Enter Sale Price">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Select Categories</label>
                            <select name="category_ids[]" class="form-control select-category" multiple="multiple">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="brand_id">Brand</label>
                            <select class="form-control select-brand" name="brand_id">
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Select Tags</label>
                            <select name="tags_ids[]" class="form-control select-tag" multiple="multiple">
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label>Additional Images</label>
                            <input type="file" class="form-control" name="images[]" multiple>
                            <div class="mt-2">
                                @foreach(json_decode($product->images, true) ?? [] as $img)
                                <img src="{{ asset($img) }}" class="img-thumbnail" width="100">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
