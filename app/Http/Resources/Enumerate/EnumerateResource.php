<?php

namespace App\Http\Resources\Enumerate;

use JsonSerializable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class EnumerateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'nameAlias' => $this->resource->name_alias,
            'enumKey' => $this->resource->enum_key,
            'type' => new EnumerateTypeResource($this->whenLoaded('type')),
            'inputType' => $this->resource->input_type,
            'isFilter' => $this->resource->is_filter,
            'status' => $this->resource->status,
        ];
    }
}
