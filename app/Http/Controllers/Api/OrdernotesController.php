<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdernoteResourceCollection;
use App\Order;
use App\Ordernote;
use App\Traits\ApiReponse;
use Illuminate\Http\Request;

class OrdernotesController extends Controller
{
    use ApiReponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ordernote  $ordernote
     * @return \Illuminate\Http\Response
     */
    public function show(Ordernote $ordernote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordernote  $ordernote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordernote $ordernote)
    {
        //
    }

}
