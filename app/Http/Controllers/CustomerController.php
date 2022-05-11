<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Inertia\Inertia;
use Illuminate\Http\Request;

//controller  used for backend only  -  controllers under Controllers/API for frontend
class CustomerController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$customers = Customer::all();

		return Inertia::render( 'Backend/Customers/Index', [

			'customers' => $customers,


		] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}


	public function show( $id ) {
		// get the customer
		$customer = Customer::findOrFail( $id );

		// get all customer orders and the products
		$orders = Order::with( 'products' )->where( 'customer_id', $customer->id )->get();

		// Partition the orders if order is sent or not
		list( $ordersNotSent, $ordersSent ) = $orders->partition( function ( $i ) {
			return $i['sent'] === 0;
		} );

		// orders not sent
		$ordersNotSent->all();
		// orders sent
		$ordersSent->all();


		return Inertia::render( 'Backend/Customers/Show', [

			'customer'      => $customer,
			'ordersNotSent' => $ordersNotSent,
			'ordersSent'    => $ordersSent,


		] );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {

	}
}
