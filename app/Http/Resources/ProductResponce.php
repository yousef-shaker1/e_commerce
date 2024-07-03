<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResponce extends JsonResource
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
            'name' => $this->name,
            'img' => $this->img,
            'description' => $this->description,
            'price' => $this->price,
            'amount' => $this->amount,
            'section_id' => $this->section_id,
        ];
    }
}
