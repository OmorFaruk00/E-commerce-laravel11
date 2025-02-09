<?php

namespace App\Repositories;

use App\Models\Brand;


class BrandRepository
{
    public function index()
    {
        $data =  Brand::get();
        return view('admin.brand.index', compact('data'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store($request)
    {
        // return $request->all();
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = uploadImage($request->file('image'), 'brand');
            $validatedData['image'] = $imagePath;
        }

        Brand::create($validatedData);
        return redirect()->back()->with('success', 'Brand created successfully!');
    }

    public function edit($brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }
    public function update($request, $brand)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            if ($brand->image) {
                $oldImagePath = public_path($brand->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imagePath = uploadImage($request->file('image'), 'brand');
            $validatedData['image'] = $imagePath;
        }

        $brand->update($validatedData);
        return redirect()->route('brand.index')->with('success', 'Brand updated successfully!');
    }

    public function destroy($brand)
    {
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully.');
    }
}
