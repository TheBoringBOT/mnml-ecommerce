<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


//=== Frontend ===

// home
Route::get( '/', function () {
	return Inertia::render( 'Home' );
} )->name( 'home' );

// about page
Route::get( '/about', function () {
	return Inertia::render( 'About' );
} )->name( 'about' );
// Info page
Route::get( '/info', function () {
	return Inertia::render( 'Info' );
} )->name( 'info' );
// search page
Route::get( '/search', [
	\App\Http\Controllers\ProductController::class,
	'search'
] )->name( 'search' );


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

// get all products by category id
Route::get( '/category/{id}', [
	\App\Http\Controllers\Api\ProductController::class,
	'apiAllProductsByCategory'
] )->name( 'products.category' );


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

// all products  via category
Route::get( '/dashboard/products/category/{id}', [
	\App\Http\Controllers\ProductController::class,
	'productsByCategory'
] )->middleware( [
	'auth',
	'verified'
] )->name( 'dashboard.products.category' );

// create product
Route::get( '/dashboard/product/create', [
	\App\Http\Controllers\ProductController::class,
	'create'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.product.create' );

// save product
Route::post( '/dashboard/product/create', [
	\App\Http\Controllers\ProductController::class,
	'store'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.product.store' );

//edit product
Route::get( '/dashboard/product/edit/{id}', [
	\App\Http\Controllers\ProductController::class,
	'edit'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.product.edit' );

//update  product
Route::post( '/dashboard/product/edit/{id}', [
	\App\Http\Controllers\ProductController::class,
	'update'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.product.update' );

//delete product
Route::get( '/dashboard/product/delete/{slug}', [
	\App\Http\Controllers\ProductController::class,
	'destroy'
] )->middleware( [ 'auth', 'verified' ] )->name( 'dashboard.product.destroy' );

// orders


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
] )->name( 'order.update' );

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
] )->middleware( [ 'auth', 'verified' ] )->name( 'customer.show' );
require __DIR__ . '/auth.php';


