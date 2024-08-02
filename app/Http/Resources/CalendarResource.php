<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'start'=>$this->start,
            'end'=>$this->end,
            // 'type'=>$this->type,
            'color'=>$this->color,
            // 'everyYear'=>$this->everyYear,
        ];
    }
}
