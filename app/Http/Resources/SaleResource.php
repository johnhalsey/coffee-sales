<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product'      => new ProductResource($this->product),
            'quantity'     => $this->quantity,
            'unit_cost'    => $this->unit_cost,
            'selling_cost' => $this->selling_cost,
        ];
    }
}
