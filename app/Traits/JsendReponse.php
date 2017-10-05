<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Tymon\JWTAuth\Facades\JWTAuth;


trait JsendReponse
{

    public function with($request)
    {
        return ['status' => 'success'];
    }

}
