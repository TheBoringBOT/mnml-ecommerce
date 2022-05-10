<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Model {
	use HasApiTokens, HasFactory, Notifiable, Billable;

	protected $guarded = [];

	public function orders() {
		return $this->hasMany( Order::class );
	}
}
