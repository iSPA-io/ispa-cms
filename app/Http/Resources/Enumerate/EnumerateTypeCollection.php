<?php

namespace App\Http\Resources\Enumerate;

use JsonSerializable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EnumerateTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => $this->collection,
            'currentPage' => $this->resource->currentPage(),
            'lastPage' => $this->resource->lastPage(),
            'perPage' => $this->resource->perPage(),
            'total' => $this->resource->total(),
        ];
    }
}
