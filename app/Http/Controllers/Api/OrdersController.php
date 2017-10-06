<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OrderResourceCollection;
use App\Http\Resources\OrderResource;
use App\Order;
use App\Orderstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrdersController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user;

        if (Gate::forUser($user)->allows('manage_orders', null)) {
            $orders = Order::query();
        } else {
            $orders = Order::where('location_id', $user->location_id);
        }

        $pageLength = request()->length;
        $resource= new OrderResourceCollection($orders->paginate($pageLength));

        return $this->apiReponse($resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('store_orders', $this->user);

        $request->validate([
            'ordercategory_id' => 'required',
            'ordervendor_id' => 'required',
            'description' => 'required',
            'part_num' => 'required',
            'qty' => 'required|numeric',
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'customer_deposit' => 'required|numeric',
            'employee_name' => 'required',
        ]);

        $status = Orderstatus::where('short_name', 'NEW')->first();
        $data = $request->all();
        $data['user_id'] = $this->user->id;
        $data['orderstatus_id'] = $status->id;
        $order = Order::create($data);

        $order->location()->associate($this->user->location)->save();

        $resource = new OrderResource($order);

        return $this->apiReponse($resource);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Order $order)
    {
        $this->authorizeForUser($this->user, 'order_location', $order);
        $resource = new OrderResource($order);
        return $this->apiReponse($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Order $order)
    {
        $this->authorizeForUser($this->user, 'update_orders');

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

        $order->update($request->all());

        $resource = new OrderResource($order);
        return $this->apiReponse($resource);
    }

    /**
     * Set order to Picked up.
     *
     * @param Order $order
     * @return mixed
     */
    public function deliver(Order $order)
    {
        $this->authorizeForUser($this->user, 'order_location', $order);
        $this->authorizeForUser($this->user, 'deliver_orders', $order);

        $status = Orderstatus::where('short_name', 'DELIVERED')->first();
        $order->status()->associate($status)->save();

        $resource = new OrderResource($order);
        return $this->apiReponse($resource);
    }
}
