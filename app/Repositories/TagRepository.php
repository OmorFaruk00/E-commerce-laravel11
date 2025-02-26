<?php

namespace App\Repositories;

use App\Models\Tag;


class TagRepository
{
    public function index()
    {
        $data =  Tag::get();
        return view('admin.tag.index', compact('data'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store($request)
    {
        $validatedData = $request->validated();    

        Tag::create($validatedData);
        return redirect()->back()->with('success', 'Tag created successfully!');
    }

    public function edit($tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }
    public function update($request, $tag)
    {
        $validatedData = $request->validated();        
        $tag->update($validatedData);
        return redirect()->route('tag.index')->with('success', 'Tag updated successfully!');
    }

    public function destroy($tag)
    {
        $tag->delete();
        return redirect()->route('tag.index')->with('success', 'Tag deleted successfully.');
    }
}
