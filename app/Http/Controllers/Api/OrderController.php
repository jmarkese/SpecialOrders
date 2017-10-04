<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResourceCollection;
use App\Http\Resources\OrderResource;
use App\Order;
use App\Orderstatus;
use Illuminate\Http\Request;
use App\Traits\ApiReponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    use ApiReponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (Gate::forUser($user)->allows('update-post', null)) {
            $orders = Order::query();
        } else {
            $orders = Order::where('user_id', $user->id);
        }

        $pageLength = request()->length;
        return new OrderResourceCollection($orders->paginate($pageLength));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ordercategory_id' => 'required',
            'ordervendor_id' => 'required',
            'description' => 'required',
            'part_num' => 'required',
            'qty' => 'required|numeric',
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'customer_deposit' => 'required|numeric',
            'emlpoyee_name' => 'required',
            'location_id' => 'required',
        ]);

        //$user = $user = JWTAuth::parseToken()->authenticate();
        $status = Orderstatus::where('short_name', 'NEW')->first();

        $data = $request->all();
        $data['user_id'] = 1;//$user->id;
        $data['orderstatus_id'] = $status->id;
        $order = Order::create($data);

        $order->save();

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OrderResource(Order::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ordercategory_id' => 'required',
            'orderstatus_id' => 'required',
            'ordervendor_id' => 'required',
            'description' => 'required',
            'part_num' => 'required',
            'qty' => 'required|numeric',
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'customer_deposit' => 'required|numeric',
            'emlpoyee_name' => 'required',
            'location_id' => 'required',
        ]);

        //$user = $user = JWTAuth::parseToken()->authenticate();
        $order = Order::find($id);

        $status = Orderstatus::where('short_name', 'NEW')->first();

        $data = $request->all();
        $data['orderstatus_id'] = $status->id;


        $order->save();

        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
