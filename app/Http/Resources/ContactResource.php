<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            "subject" => $this->subject,
            "message" => $this->message,
            "email" => $this->email,
            "phone" => $this->phone,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
