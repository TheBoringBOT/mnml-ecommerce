<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;

// Controller used for frontend

class ProductController extends Controller {


	//=== API ROUTES FOR VUEX STORE ===//
	// get all products
	public function apiAllProducts() {
		$products   = Product::with( 'categories:id,name', 'images' )->get();
		$categories = Category::all();


		return array( [ 'products' => $products, 'categories' => $categories ] );
	}

	// get single product
	public function apiSingleProduct( $productId ) {
		$product = Product::find( $productId );


		return $product;
	}

	public function apiProductByCategory( $id ) {
		//$categoryName = Category::findOrFail( $id );


		return Inertia::render( 'Frontend/Product/Index', [
			'categoryId' => $id,


		] );
	}


	// all products page
	public function index() {

		$categories = Category::all();

		return Inertia::render( 'Frontend/Product/Index', [
			'categories' => $categories

		] );
	}

	// get single product page
	public function show( $slug ) {

		// A fix for seo
		//?vuex renders later then interjs head.
		// TODO  Find a way to render seo from store instead of a call to db
		$product = Product::where( 'slug', $slug )->first();
		$seo     = (object) array(
			'title'       => $product->name,
			'description' => $product->excerpt,
		);


		return Inertia::render( 'Frontend/Product/Show', [
			'productSlug' => $slug,
			'seo'         => $seo


		] );
	}

	public function apiAllProductsByCategory( $id ) {
		$categoryName = Category::findOrFail( $id );

		return Inertia::render( 'Frontend/Product/Index', [
			'categoryId'   => $id,
			'categoryName' => $categoryName->name,


		] );
	}


}
