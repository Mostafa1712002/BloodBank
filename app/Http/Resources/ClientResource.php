<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "d_o_b" => $this->d_o_b,
            "blood_type_id" => $this->bloodType->name,
            "last_donation_date" => $this->last_donation_date,
            "city_id" => $this->city->name,
            "created_at" => $this->created_at->format("Y-m-d H:i A"),
            "updated_at" => $this->updated_at->format("Y-m-d H:i A"),
        ];
    }
}
