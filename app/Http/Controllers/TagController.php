<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Repositories\TagRepository;

class TagController extends Controller
{
    public $tagRepository;
    public function  __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;        
    }
 
    public function index()
    {
        return $this->tagRepository->index();       
    }

  
    public function create()
    {
        return $this->tagRepository->create();
    }  

    public function store(TagRequest $request)    
    {
        return $this->tagRepository->store($request);
    }

 
    public function show(Tag $tag)
    {
        return $tag;
    }
   
    public function edit(Tag $tag)
    {
        return $this->tagRepository->edit($tag);
    }
  
    public function update(tagRequest $request, Tag $tag)
    {
        return $this->tagRepository->update($request,$tag);
    }
  
    public function destroy(Tag $tag)
    {
        return $this->tagRepository->destroy($tag);
    }
}
