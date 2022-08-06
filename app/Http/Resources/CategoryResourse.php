<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;

class CategoryResourse extends JsonResource
{
    public static $wrap = null;
    public $statusCode;

    public function __construct($resource, $statusCode = 201)
    {
        parent::__construct($resource);

        $this->statusCode = $statusCode;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'category' => [
                'title' => $this->title,
                'description' => $this->description,
                'photo' => $this->photo,
                'status' => $this->status,
            ],
            'message' => 'Category Created Successfully'
        ];
    }

    public function toResponse($request)
    {
        return (new ResourceResponse($this))->toResponse($request)->setStatusCode($this->statusCode);
    }
}
