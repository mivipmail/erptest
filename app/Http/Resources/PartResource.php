<?php

namespace App\Http\Resources;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartResource extends JsonResource
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
            'title' => $this->title,
            'qty' => $this->qty,
            'source' => $this->source->title,
            'laser' => $this->laser,
            'welding' => $this->welding,
            'assembling' => $this->assembling,
            'electro' => $this->electro,
            'parts' => count($this->parts) 
                ? $this->parts->map(function ($item) {
                    $item['qty'] = $item->pivot->qty;
                    unset($item['pivot']);
                    return $item;
                }) 
                : null,
            'order_idx' => $this->order_idx,
            'canDelete' => Part::whereHas('compounds', fn ($query) => $query->where('part_id', $this->id))->count() == 0,
        ];
    }
}
