<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;


class CategoryRepository
{
    public function index()
    {
        $data =  Category::get();
        return view('admin.category.index', compact('data'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store($request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = uploadImage($request->file('image'), 'category');
            $validatedData['image'] = $imagePath;
        }

        Category::create($validatedData);
        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function edit($category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update($request, $category)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imagePath = uploadImage($request->file('image'), 'category');
            $validatedData['image'] = $imagePath;
        }

        $category->update($validatedData);
        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
