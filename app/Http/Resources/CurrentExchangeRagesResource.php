<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property  string date
 * @property  mixed data
 */
class CurrentExchangeRagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'date' => $this->date,
            'data' => json_decode($this->data),
        ];
    }
}
