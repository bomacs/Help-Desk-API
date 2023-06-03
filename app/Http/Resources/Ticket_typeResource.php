<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket_typeResource extends JsonResource
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
            'id' => $this->id,
            'type' => 'Ticket_types',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'sla_mins' => $this->sla_mins,
                'department'=> [
                    "id" => $this->department->id,
                    "name" => $this->department->name,
                    "email" => $this->department->email,
                    "description" => $this->department->description,
                ]
            ]
        ];
    }
}
