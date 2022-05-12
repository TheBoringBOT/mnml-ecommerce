<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification {
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */

	public function __construct( $customer, $order ) {
		$this->customer = $customer;
		$this->order    = $order;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return array
	 */
	public function via( $notifiable ) {
		// creates notification to send via email and also store in DB
		return [ 'mail', 'database' ];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail( $notifiable ) {
		    $customer = $this->customer;

		return ( new MailMessage )->greeting( 'Hi '.$customer->name.',' )->line( 'Thank you for ordering with us!' )->line( 'Expect your product in 2-5 days' );

	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return array
	 */
	// send notification to database
	public function toDatabase( $notifiable ) {
		return [
			'order'    => $this->order,
			'customer' => $this->customer
		];
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return array
	 */
	public function toArray( $notifiable ) {
		return [//
		];
	}
}
