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
		// get the total amount of sales
		$salesTotal     = $orders->sum( 'total' );
		$ordersTotal    = count( $orders );
		$customersTotal = count( $customers );

		$ordersToSend = count( $orders->where( 'sent', 0 ) );

		$summaryData = (object) array(
			'salesTotal'     => $salesTotal,
			'ordersTotal'    => $ordersTotal,
			'customersTotal' => $customersTotal,
			'ordersToSend'   => $ordersToSend
		);


		return Inertia::render( 'Backend/Dashboard', [

			'customers'   => $customers,
			'orders'      => $orders,
			'summaryData' => $summaryData,


		] );

	}
}
