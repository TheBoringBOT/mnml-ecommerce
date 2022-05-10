<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller {

	//=== API ROUTES FOR VUEX STORE ===//
	// get all products
	public function apiAllProducts() {

		return Product::with( 'categories:id,name' )->get();
	}

	// get single product
	public function apiSingleProduct( $productId ) {
		$product = Product::find( $productId );

		return $product;
	}


	// all products page
	public function index() {


		return Inertia::render( 'Frontend/Product/Index', [


		] );
	}

	// get single product page
	public function show( $slug ) {
		return Inertia::render( 'Frontend/Product/Show', [
			'productSlug' => $slug


		] );
	}


}
