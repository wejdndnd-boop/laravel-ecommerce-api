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
        'id' => $this->id,
        'product_name' => $this->name, // fiyak tghayyer el esem hon
        'details' => $this->description,
        'price_usd' => $this->price,
        'stock_count' => $this->stock,
        'status' => $this->is_active ? 'Available' : 'Out of Stock',
        'created_at' => $this->created_at->format('Y-m-d'),
    ];
}
}
