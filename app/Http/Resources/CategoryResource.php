<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the category resource into an array.
     *
     * This method transforms a Category model instance into an array representation
     * that will be used for API responses. It includes the category's ID, name, and
     * parent_id attributes, providing a simplified representation of the category
     * that can be included in product responses or used in category listings.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request
     * @return array<string, mixed>  The transformed category data
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ];
    }
}
