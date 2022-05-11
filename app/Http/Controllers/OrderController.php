<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Http\Request;


class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// get each order with the product
		$orders = Order::with( 'products' )->get();

		// map through orders and attach customer details
		$orders->map( function ( $i ) {

			// Add customer details to each order
			$i['customer'] = Customer::findorFail( $i->customer_id );
		} );


		return Inertia::render( 'Backend/Orders/Index', [

			'orders' => $orders,

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

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * change the order status of the specified resource to sent .
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function updateOrderSent( $id ) {
		$order = Order::findOrFail( $id )->get();
		$order->update( 'sent', 1 );


	}

	/**
	 * change the order status of the specified resource to processing (not sent) .
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function updateOrderProcessing( $id ) {
		$order = Order::findOrFail( $id )->get();
		$order->update( 'sent', 0 );


	}


}
