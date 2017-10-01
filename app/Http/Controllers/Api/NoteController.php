<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Ordernote;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;

class NoteController extends Controller
{
    use JsonApiReponse;
    use Helpers;

    /**
     * Display a listing of the resource.s
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = new NotesResourceCollection(Ordernote::query(['user', 'order'])->paginate());
        return $this->jsonApi($resource);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Ordernote  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Ordernote $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ordernote  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordernote $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ordernote  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordernote $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ordernote  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordernote $notes)
    {
        //
    }
}
