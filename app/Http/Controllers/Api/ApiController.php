<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\ApiReponse;

abstract class ApiController extends Controller
{
    use ApiReponse;

    /**
     * @var authenticated user
     */
    protected $user;

    /**
     * Set the authenticatec user
     *
     * OrdersController constructor.
     */
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
}