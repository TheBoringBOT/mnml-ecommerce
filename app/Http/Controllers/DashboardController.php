<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
Use App\Models\Product;
use Inertia\Inertia;

class DashboardController extends Controller {
	public function index() {
		// Get All customers
		$customers = Customer::all();

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


		return Inertia::render( 'Backend/Customers/Show', [

			'customers'     => $customers,
			'ordersNotSent' => $ordersNotSent,
			'ordersSent'    => $ordersSent,


		] );

	}
}
