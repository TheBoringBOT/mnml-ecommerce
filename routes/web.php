<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//=== Frontend ===

// home
Route::get( '/', function () {
	return Inertia::render( 'Welcome', [
		'canLogin'       => Route::has( 'login' ),
		'canRegister'    => Route::has( 'register' ),
		'laravelVersion' => Application::VERSION,
		'phpVersion'     => PHP_VERSION,
	] );
} );

// these routes just render the componets
// the actual functions to get the products data is found in api.php

// get all products
Route::get( '/products', [
	\App\Http\Controllers\Api\ProductController::class,
	'index'
] )->name( 'products' );

// get single Product via slug
Route::get( '/product/{slug}', [
	\App\Http\Controllers\Api\ProductController::class,
	'show'
] )->name( 'products.item' );

//TODO change the orders routes to controllers once setup
//order  checkout
Route::inertia( '/checkout', 'Frontend/Order/Checkout' )->name( 'order.checkout' );

//order summary
Route::inertia( '/summary', 'Frontend/Order/Summary' )->name( 'order.summary' );


//=== Backend ===

// dashboard
Route::get( '/dashboard', [ \App\Http\Controllers\DashboardController::class, 'index' ] )->middleware( [
	'auth',
	'verified'
] )->name( 'dashboard' );

// all products
Route::get( '/dashboard/products', [ \App\Http\Controllers\ProductController::class, 'index' ] )->middleware( [
	'auth',
	'verified'
] )->name( 'dashboard.products' );

// create product
Route::get( '/dashboard/product/create', [
	\App\Http\Controllers\ProductController::class,
	'create'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.products.create' );

//edit product
Route::get( '/dashboard/product/edit/{slug}', [
	\App\Http\Controllers\ProductController::class,
	'edit'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.products.edit' );

//delete product
Route::get( '/dashboard/product/delete/{slug}', [
	\App\Http\Controllers\ProductController::class,
	'destroy'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.products.delete' );

// orders

// show all orders
Route::get( '/dashboard/orders', [
	\App\Http\Controllers\OrderController::class,
	'index'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.orders' );
require __DIR__ . '/auth.php';

// show single order
Route::get( '/dashboard/order/{id}', [
	\App\Http\Controllers\OrderController::class,
	'show'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.order.show' );
require __DIR__ . '/auth.php';

// update order status
Route::get( '/dashboard/order/update/{id}', [
	\App\Http\Controllers\OrderController::class,
	'updateOrderStatus'
] )->middleware( [
	'auth',
	'verified'
] )->name( 'dashboard.order.update' );

//== Customers Backend

// show all customers
Route::get( '/dashboard/customers', [
	\App\Http\Controllers\CustomerController::class,
	'index'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.customers' );
require __DIR__ . '/auth.php';

// show single customer
Route::get( '/dashboard/customer/{id}', [
	\App\Http\Controllers\CustomerController::class,
	'show'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.customer.show' );
require __DIR__ . '/auth.php';


