<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'description' => $this->description,
            'created_at' => $this->created_at,
            // 'user'=>$this->user?[
            //     'id'=> $this->user->id,
            //     'name'=> $this->user->name,
            //     'email'=> $this->user->email,
            // ]:null,
            'user' => new UserResource($this->user),
        ];
    }
}
