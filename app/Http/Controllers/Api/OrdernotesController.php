<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OrdernoteResource;
use App\Http\Resources\OrdernoteResourceCollection;
use App\Ordernote;
use Illuminate\Http\Request;

class OrdernotesController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

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
        $this->authorizeForUser($this->user, 'order_location', $ordernote->order);
        $resource = new OrdernoteResource($ordernote);
        return $this->apiReponse($resource);
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
