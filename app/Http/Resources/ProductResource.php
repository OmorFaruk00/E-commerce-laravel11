<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'regular_price'     => (float) $this->regular_price,
            'sale_price'        => (float) $this->sale_price,
            'sku'               => $this->sku,
            'stock_status'      => $this->stock_status,
            'featured'          => (bool) $this->featured,
            'quantity'          => (int) $this->quantity,
            'categories'        => $this->categories->pluck('name')->implode(', '),
            'tags'              => $this->tags->pluck('name')->implode(', '),
            'brand'             => $this->brand->name,
            'image'             => $this->image ?? asset('images/default.png'),
            'images'            => json_decode($this->images, true) ?? [],
         
        ];
    }
}
