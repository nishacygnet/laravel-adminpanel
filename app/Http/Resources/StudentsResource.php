<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class StudentsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'gender'        => $this->gender,
            'profile_picture' => $this->profile_picture,
            'hobbies'       => $this->hobbies,
            'standard'      => $this->standard,
            'created_at'    => $this->created_at->toDateString(),
        ];
    }
}
