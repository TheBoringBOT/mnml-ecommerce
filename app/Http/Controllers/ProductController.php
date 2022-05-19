<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use File;
use Illuminate\Support\Facades\Storage;

//controller  used for backend only  -  controllers under Controllers/API for frontend

class ProductController extends Controller {
	/**
	 * Display a listing of the resource. - used for backend/products table
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$products   = Product::with( 'images' )->get();
		$categories = Category::all();

		return Inertia::render( 'Backend/Product/Products', [
			'products'   => $products,
			'categories' => $categories,

		] );


	}

	public function productsByCategory( $id ) {
		// gets the product by relationship category {id}
		$products = Product::with( 'images' )->whereHas( 'categories', function ( $q ) USE ( $id ) {
			$q->where( 'id', $id );

		} )->get();


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
		// This update the collection to work with the tagging system. Requirements of (value, label) are needed
		$categories = Category::get()->map( function ( $cat ) {
			return [ 'value' => $cat->id, 'label' => $cat->name, ];
		} )->toArray();

		return Inertia::render( 'Backend/Product/CreateProduct', [

			'categories' => $categories,
		] );
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
			'price'       => 'required|digits_between:0,5',
			'available'   => 'required|digits_between:0,5',
			'care'        => 'required | string|min:1|max:100',
			'materials'   => 'required | string|min:1|max:100',
			'categories'  => 'required',
			'description' => 'required | string|min:1|max:200',
			'story'       => 'required | string|min:1|max:200',
			//			'images'      => 'mimes:jpeg,bmp,png,jpg',


		] );


		// Create slug for assets & product
		$slug = SlugService::createSlug( Product::class, 'slug', $request->name );


		// Create Product in DB
		$product = Product::create( [


			'name'        => $request->get( 'name' ),
			'price'       => $request->get( 'price' ),
			'available'   => $request->get( 'available' ),
			'care'        => $request->get( 'care' ),
			'materials'   => $request->get( 'materials' ),
			'description' => $request->get( 'description' ),
			'story'       => $request->get( 'story' ),
			'slug'        => $slug,


		] );
		// combine the category with the product in pivot table  category_product
		$product->categories()->attach( $request->categories );
		// Folder location for images
		$image_location = 'uploads/images/product/' . $slug;
		// Check if folder exists, make if not
		if ( ! file_exists( $image_location ) ) {
			File::makeDirectory( $image_location, $mode = 0777, true, true );


		}
		// Rename the Image file and save in the folder
		$images = $request->file( 'images' );
		// for each the images
		foreach ( $images as $image ) {


			$image_name = $slug . '_' . uniqid( '', true ) . '.jpg';
			$imgFile    = Image::make( $image->getRealPath() );

			// create xl image (default uploaded image 1200x1200)
			$imgFile->save( $image_location . '/' . 'XL_' . $image_name );

			// create large image 600x600
			$imgFile->resize( 600, null, function ( $constraint ) {
				$constraint->aspectRatio();
			} )->save( $image_location . '/' . 'LG_' . $image_name );

			// create medium   300x300
			$imgFile->resize( 300, null, function ( $constraint ) {
				$constraint->aspectRatio();
			} )->save( $image_location . '/' . 'MD_' . $image_name );


			// Image path for database - using large (600x600) as default
			$image_path = '/' . $image_location . '/' . 'LG_' . $image_name;

			// this is the reason of saved product
			$product->images()->create( [
				'image_url' => $image_path,
			] );
		}


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

		// This retrieves the categories for the product then updates the categories
		// to work with the tagging   system. Requirements of (value, label) are needed
		$categories = $product->categories()->get()->map( function ( $cat ) {
			return [ 'value' => $cat->id, 'label' => $cat->name, ];
		} )->toArray();


		return Inertia::render( 'Backend/Product/EditProduct', [
			'product'    => $product,
			'categories' => $categories,

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
		$product     = Product::findorFail( $id );
		$updateImage = false;

		$request->validate( [
			'name'        => 'required | string|min:1|max:100',
			'price'       => 'required|digits_between:0,5',
			'available'   => 'required|digits_between:0,5',
			'care'        => 'required | string|min:1|max:100',
			'materials'   => 'required | string|min:1|max:100',
			'categories'  => 'required',
			'description' => 'required | string|min:1|max:200',
			'story'       => 'required | string|min:1|max:200',
			'image'       => 'mimes:jpeg,bmp,png,jpg',
		] );


		// Create slug for assets & product
		$slug = SlugService::createSlug( Product::class, 'slug', $request->name );

		if ( $request->image ) {
			$updateImage = true;
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
		}


		//TODO update needs to fixed using better query, research then add later
		// Create Product in DB
		$product = Product::update( [
			'name'        => $request->get( 'name' ),
			'price'       => $request->get( 'price' ),
			'available'   => $request->get( 'available' ),
			'care'        => $request->get( 'brand' ),
			'materials'   => $request->get( 'materials' ),
			'description' => $request->get( 'description' ),
			'story'       => $request->get( 'story' ),
			'slug'        => $slug,
			'image'       => $image_path,

		] );
		// combine the category with the product in pivot table  category_product
		$product->categories()->attach( $request->categories );


		return Redirect::route( 'dashboard.product.edit' );

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		// find the product
		$product = Product::findOrFail( $id );
		// get product categories
		$productCategories = $product->categories()->get();
		//if categories then detach them from product
		if ( $productCategories ) {
			$product->categories()->detach( $productCategories );
		}
		//delete product
		$product->delete();

		//TODO - The issues with deleting is that if there is a stored order then the product details will not be           //available and cause conflicts on orders history - Perhaps hide product?
	}
}
