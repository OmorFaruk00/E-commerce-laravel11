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
         $data = ProductResource::collection($products);

       


    foreach ($data as $product) {
        echo "Product Name: " . $product->name . "<br>";

        echo "Categories: $product->categories";
        // foreach ($product->categories as $category) {
        //     echo $category->name . ", ";
        // }
        // echo "<br>";

        // echo "Tags: ";
        // foreach ($product->tags as $tag) {
        //     echo $tag->name . ", ";
        // }
        echo "<br><br>";
    }

    return 'ok';
        
        return view('admin.product.index', compact('data'));
    }

    public function create()
    {
        $tags = Tag::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create',['brands' =>$brands,'categories'=>$categories,'tags'=>$tags]);
    }

    public function store($request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $image = uploadImage($request->file('image'), 'product');
            $validatedData['image'] = $image;
        }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path =  uploadImage($image, 'product');
                $images[] = $path; 
            }
        }
        $validatedData['images'] = json_encode($images);
        unset($validatedData['category_ids']);
        unset($validatedData['tags_ids']);
        $product = Product::create($validatedData);
    
        
        if ($request->has('category_ids')) {
            $product->categories()->attach($request->category_ids);
        }   
        if ($request->has('tags_ids')) {
            $product->tags()->attach($request->tags_ids);
        } 

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    public function edit($product)
    {
        return view('admin.product.edit', compact('product'));
    }
    public function update($request, $product)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImagePath = public_path($product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imagePath = uploadImage($request->file('image'), 'product');
            $validatedData['image'] = $imagePath;
        }

        $product->update($validatedData);
        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
