<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use \Cviebrock\EloquentSluggable\Services\SlugService;

//controller  used for backend only  -  controllers under Controllers/API for frontend

class ProductController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$products   = Product::all();
		$categories = Category::all();


		return Inertia::render( 'Backend/Product/Products', [
			'products'   => $products,
			'categories' => $categories,

		] );


	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {

		$request->validate( [
			'name'        => 'required | string|min:1|max:100',
			'brand'       => 'required | string|min:1|max:100',
			'description' => 'required | string|min:1|max:200',
			'available'   => 'required|digits_between:0,5',
			'price'       => 'required|digits_between:0,5',
			'image'       => 'mimes:jpeg,bmp,png,jpg|dimensions:width=960,height=1422',
			'categories'  => 'required',

		] );

		// Create slug for assets & product
		$slug = SlugService::createSlug( Screenplay::class, 'slug', $request->name );

		// Folder location for images
		$image_location = 'uploads/images/product/' . $slug;
		// Check if folder exists, make if not
		if ( ! file_exists( $image_location ) ) {
			Storage::makeDirectory( $image_location );

		}

		// Rename the Image file and save in the folder
		$image      = $request->file( 'image' );
		$image_name = $slug . '.jpg';
		$imgFile    = Image::make( $image->getRealPath() );

		// create xl image (default uploaded image)
		$imgFile->save( $image_location . '/' . 'xl_' . $image_name );

		// create large image
		$imgFile->resize( 600, null, function ( $constraint ) {
			$constraint->aspectRatio();
		} )->save( $image_location . '/' . 'lg_' . $image_name );

		// create medium
		$imgFile->resize( 300, null, function ( $constraint ) {
			$constraint->aspectRatio();
		} )->save( $image_location . '/' . 'md_' . $image_name );

		// create small
		$imgFile->resize( 150, null, function ( $constraint ) {
			$constraint->aspectRatio();
		} )->save( $image_location . '/' . 'sm_' . $image_name );

		// Image path for database - using large (600x600) as default
		$image_path = '/' . $image_location . '/' . 'lg_' . $image_name;


		// Create Product in DB
		$product = Product::create( [

			'name'        => $request->get( 'name' ),
			'brand'       => $request->get( 'brand' ),
			'slug'        => $slug,
			'description' => $request->get( 'description' ),
			'available'   => $request->get( 'available' ),
			'price'       => $request->get( 'price' ),
			'image'       => $image_path,

		] );
		// combine the category with the product in pivot table  category_product
		$product->categories()->attach( $request->categories );


		return Redirect::route( 'dashboard.product.create' );


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$product = Product::findOrFail( $id );


		return Inertia::render( 'Backend/Product/EditProduct', [
			'product' => $product,

		] );

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
