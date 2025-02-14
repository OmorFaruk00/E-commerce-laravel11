<?php
namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

class ProductRepository
{
    public function index()
    {
        $products = Product::with('categories', 'brand', 'tags')->get();
        $data     = ProductResource::collection($products);
        return view('admin.product.index', compact('data'));
    }

    public function create()
    {
        $tags       = Tag::select('id', 'name')->get();
        $brands     = Brand::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', ['brands' => $brands, 'categories' => $categories, 'tags' => $tags]);
    }

    public function store($request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $image                  = uploadImage($request->file('image'), 'product');
            $validatedData['image'] = $image;
        }

        $images = [];

        $validatedData['images'] = json_encode($images);
        unset($validatedData['category_ids']);
        unset($validatedData['tags_ids']);
        unset($validatedData['images']);
        $product = Product::create($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = uploadImage($image, 'product');
                $product->images()->create(['path' => $path]);
            }
        }

        if ($request->has('category_ids')) {
            $product->categories()->attach($request->category_ids);
        }
        if ($request->has('tags_ids')) {
            $product->tags()->attach($request->tags_ids);
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $tags               = Tag::select('id', 'name')->get();
        $brands             = Brand::select('id', 'name')->get();
        $categories         = Category::select('id', 'name')->get();
        $product            = Product::with('categories', 'tags')->findOrFail($id);
        $selectedCategories = $product->categories->pluck('id')->toArray();
        $selectedTags       = $product->tags->pluck('id')->toArray();
        return view('admin.product.edit', compact('product', 'brands', 'categories', 'tags', 'selectedCategories', 'selectedTags'));
    }
    public function update($request, $product)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            unlink($product->image);
            $image                  = uploadImage($request->file('image'), 'product');
            $validatedData['image'] = $image;
        }

        if ($request->hasFile('images')) {
            foreach ($product->images as $image) {
                unlink($image->path); // Delete image file from storage
                $image->delete();     // Delete the record from the database
            }
        }

        unset($validatedData['category_ids']);
        unset($validatedData['tags_ids']);
        unset($validatedData['images']);
        $product->update($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = uploadImage($image, 'product');
                $product->images()->create(['path' => $path]);
            }
        }

        if ($request->has('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        if ($request->has('tags_ids')) {
            $product->tags()->sync($request->tags_ids);
        }
        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($product)
    {
        if ($product->image) {
            unlink($product->image);
        }

        if ($product->images) {
            foreach ($product->images as $image) {
                unlink($image->path);
                $image->delete();
            }
        }

        $product->categories()->detach();
        $product->tags()->detach();

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
