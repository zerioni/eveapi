<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlueprintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->typeID,
            'name' => $this->item->typeName,
            'product' => $this->product->typeName,
            'materials' => MaterialResource::collection($this->materials),
            'basecost' => $this->baseCost(),
            'basevalue' => $this->product->basePrice,
            'baseprofit' => $this->product->basePrice - $this->baseCost()
        ];
    }
}
