<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller {

	//TODO setup validation of inputs on client side + server side

	public function purchase( Request $request ) {

		// Validation
		$request->validate( [
			'first_name' => 'required |string',
			'last_name'  => 'required |string',
			'address'    => 'required |string',
			'city'       => 'required |string',
			'state'      => 'required |string',
			'zip_code'   => 'required |string',
			'email'      => 'required|email',


		] );


		$customer = Customer::firstOrCreate( [
			'email' => $request->input( 'email' )
		], [
			'password' => Hash::make( Str::random( 12 ) ),
			'name'     => $request->input( 'first_name' ) . ' ' . $request->input( 'last_name' ),
			'address'  => $request->input( 'address' ),
			'city'     => $request->input( 'city' ),
			'state'    => $request->input( 'state' ),
			'zip_code' => $request->input( 'zip_code' )
		] );

		try {


			$payment = $customer->charge( $request->input( 'amount' ), $request->input( 'payment_method_id' ), [
				'receipt_email' => $request->input( 'email' ),
				//TODO add description from cart items
				//				'description'   => $description
			] );

			$payment = $payment->asStripePaymentIntent();

			$order = $customer->orders()->create( [
				'transaction_id' => $payment->charges->data[0]->id,
				'total'          => $payment->charges->data[0]->amount
			] );


			foreach ( json_decode( $request->input( 'cart' ), true ) as $item ) {
				$order->products()->attach( $item['id'], [ 'quantity' => $item['quantity'] ] );
				// updates product quantity
				Product::where( 'id', $item['id'] )->decrement( 'available', $item['quantity'] );
			}

			//Send email to customer
			Mail::to( $request->input( 'email' ) )->send( new OrderNotification() );
			//Todo add data to the email - Name, total, product, event date etc.
			//TODO add ticket or something within the email

			$order->load( 'products' );


			return $order;


		} catch ( \Exception $e ) {
			return response()->json( [ 'message' => $e->getMessage() ], 500 );
		}

	}


	// after successful purchase redirect customer to order summary page
	public function orderSummary( $order ) {


		return inertia( 'Frontend/Order/Summary', [ 'order' => $order ] );
	}

}