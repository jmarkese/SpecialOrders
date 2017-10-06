<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResource;
use App\Traits\ApiReponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SessionsController extends Controller
{

    use ApiReponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = \App\User::create($request->all());
        $token = JWTAuth::fromUser($user);

        return $this->apiReponse(new SessionResource(null), $token);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function show(User $id=null)
    {
        // @TODO
    }
}
