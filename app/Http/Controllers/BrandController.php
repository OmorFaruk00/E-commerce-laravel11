<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Repositories\BrandRepository;

class BrandController extends Controller
{
    public $brandRepository;
    public function  __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;        
    }
 
    public function index()
    {
        // return 'ok';
        return $this->brandRepository->index();       
    }

  
    public function create()
    {
        return $this->brandRepository->create();
    }  

    public function store(BrandRequest $request)    
    {
        // return $request->image;
        return $this->brandRepository->store($request);
    }

 
    public function show(Brand $brand)
    {
        return $brand;
    }
   
    public function edit(Brand $brand)
    {
        return $this->brandRepository->edit($brand);
    }
  
    public function update(BrandRequest $request, Brand $brand)
    {
        return $this->brandRepository->update($request,$brand);
    }
  
    public function destroy(Brand $brand)
    {
        return $this->brandRepository->destroy($brand);
    }
}
