<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Tymon\JWTAuth\Facades\JWTAuth;


trait ApiReponse
{

    public function apiReponse(Resource $resource, $token = null)
    {
        $token = $token ?: JWTAuth::getToken();
        return $resource
            //->additional(['status' => 'success'])
            ->response()
            ->header('Authorization', 'Bearer ' . $token);
    }

}
