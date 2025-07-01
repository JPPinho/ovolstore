<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the product resource into an array.
     *
     * This method transforms a Product model instance into an array representation
     * that will be used for API responses. It includes all essential product attributes
     * and conditionally includes related categories when they have been loaded.
     * The whenLoaded method ensures categories are only included when the relationship
     * has been explicitly loaded, preventing N+1 query issues.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request
     * @return array<string, mixed>  The transformed product data
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
