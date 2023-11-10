<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponse extends JsonResource
{
    public $status;
    public $message;

    public function __construct($resource, $status = 0, $message = 'success')
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource
        ];
    }
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }
}
