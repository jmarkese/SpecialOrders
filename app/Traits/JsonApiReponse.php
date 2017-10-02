<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Tymon\JWTAuth\Facades\JWTAuth;


trait JsonApiReponse
{

    public function jsonApi(Resource $resource, $token = null)
    {
        $token = $token ?: JWTAuth::getToken();
        $resource = $resource->response();
        $resource->header('Content-Type', 'application/vnd.api+json');

        if($token){
            $resource->header('Authorization', 'Bearer ' . $token);
        }

        return $resource;
    }

}
