<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationRequestResource extends JsonResource
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
            "patient_name" => $this->patient_name,
            "patient_age" => $this->patient_age,
            "patient_phone" => $this->patient_phone,
            "hospital_name" => $this->hospital_name,
            "hospital_address" => $this->hospital_address,
            "bags_num" => $this->bags_num,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "client" => $this->client,
            "blood_type" => $this->bloodType,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
