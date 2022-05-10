<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable, Billable;


	protected $guarded = [];


	protected $hidden = [
		'password',
		'remember_token',
	];


}
