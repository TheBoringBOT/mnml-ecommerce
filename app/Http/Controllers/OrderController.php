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
	 *
	 */
	public function index() {
		// get each order with the product
		$orders = Order::with( 'products' )->get();

		// map through orders and attach customer details
		$orders->map( function ( $i ) {
			// Add customer details to each order
			$i['customer'] = Customer::findorFail( $i->customer_id );
		} );

		// Partition the orders if order is sent or not
		list( $ordersNotSent, $ordersSent ) = $orders->partition( function ( $i ) {
			return $i['sent'] === 0;
		} );

		// orders not sent
		$ordersNotSent->all();
		// orders sent
		$ordersSent->all();




		return Inertia::render( 'Backend/Orders/Index', [

			'ordersNotSent' => $ordersNotSent,
			'ordersSent'    => $ordersSent,

		] );
	}

	// ? Order is created wiithin /Http/Controllers/Api/CustomerController.php


	public function show( $id ) {
		// get order
		$order = Order::findOrFail( $id );
		// get order product details
		$product = $order->products()->get();
		// add product details to order collection
		$order['product'] = $product;
		//add full customer details to order collection
		$order['customer'] = Customer::findorFail( $order->customer_id );


		return Inertia::render( 'Backend/Orders/Show', [

			'order' => $order,


		] );
	}

	/**
	 * change the order status of the specified resource -
	 * it will change to opposite of whatever is the current .
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function updateOrderStatus( $id ) {

		// find order
		$order = Order::findOrFail( $id );
		// update order status  opposite to current status
		$response = $order->update( [ 'sent' => ! $order->sent ] );

		// return success if updates
		return response()->json( [ 'success' => $response ] );
	}


}
