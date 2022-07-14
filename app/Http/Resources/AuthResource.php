<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;

class AuthResource extends JsonResource
{
    public static $wrap = null;
    private $statusCode;
    private $message = [
        201 => 'Registered successfully',
        200 => 'Logged in successfully',
    ];

    public function __construct($resource, $statusCode = 200)
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
            'name' => $this->name,
            'token' => $this->createToken($this->email . '_token')->plainTextToken,
            'message' => $this->message[$this->statusCode]
        ];
    }

    public function toResponse($request)
    {
        return (new ResourceResponse($this))->toResponse($request)->setStatusCode($this->statusCode);
    }
}
