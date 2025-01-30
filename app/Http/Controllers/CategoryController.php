<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public $categoryRepository;
    public function  __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;        
    }
 
    public function index()
    {
        return $this->categoryRepository->index();       
    }

  
    public function create()
    {
        return $this->categoryRepository->create();
    }  

    public function store(CategoryRequest $request)    
    {
        return $this->categoryRepository->store($request);
    }

 
    public function show(Category $category)
    {
        return $category;
    }
   
    public function edit(Category $category)
    {
        return $this->categoryRepository->edit($category);
    }
  
    public function update(CategoryRequest $request, Category $category)
    {
        return $this->categoryRepository->update($request,$category);
    }
  
    public function destroy(Category $category)
    {
        return $this->categoryRepository->destroy($category);
    }
}
