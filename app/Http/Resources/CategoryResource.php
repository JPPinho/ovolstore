<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the category resource into an array.
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
            'children' => CategoryResource::collection($this->whenLoaded('childrenRecursive')),
        ];
    }
}
