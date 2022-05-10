<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;


class MailController extends Controller {

	// send email notification to customer after purchase success
	public function sendOrderNotificationEmail() {

		Mail::to( 'example@dude.com' )->send( new OrderNotification() );


	}
}
