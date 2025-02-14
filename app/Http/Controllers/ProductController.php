<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{

    public $productRepository;
    public function  __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;        
    }
 
    public function index()
    {
        return $this->productRepository->index();       
    }

  
    public function create()
    {
        return $this->productRepository->create();
    }  

    public function store(ProductRequest $request)    
    {
        return $this->productRepository->store($request);
    }

 
    public function show(Product $product)
    {
        return $product;
    }
   
    public function edit($id)
    {
        return $this->productRepository->edit($id);
    }
  
    public function update(ProductRequest $request, Product $product)
    {
        return $this->productRepository->update($request,$product);
    }
  
    public function destroy(Product $product)
    {
        return $this->productRepository->destroy($product);
    }
    public function product($category=null, $Product=null)
    {
        $categoryIds = json_decode($category, true);
        $ProductIds = json_decode($Product, true);
        
       return  $products = Product::with('categories', 'brand', 'tags')
        ->when(!empty($categoryIds), function ($query) use ($categoryIds) {
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        })
        ->when(!empty($ProductIds), function ($query) use ($ProductIds) {
            $query->whereIn('Product_id', $ProductIds);
        })
        ->get();

            return ProductResource::collection($products);

           
    }

   
}
