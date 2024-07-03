<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'department_id'=>$this->department_id,
            'photo'=> $this->photo,
            'is_active'=>$this->is_active,
            'is_admin_department'=>$this->is_admin_department,
            'is_maintenance'=>$this->is_maintenance,
            'is_it'=>$this->is_it,
            'is_admin'=>$this->is_admin,
        ];
    }
}
