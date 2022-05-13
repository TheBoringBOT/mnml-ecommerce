<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateProductsTable extends Migration {


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {


		Schema::create( 'products', function ( Blueprint $table ) {

			// default text for demo app
			$loremIpsum = " Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam convallis. Maecenas ut tellus mi. Proin tincidunt, lectus eu volutpat mattis, ante metus lacinia tellus, vitae condimentum nulla enim bibendum nibh. Praesent turpis risus, interdum nec venenatis id, pretium sit amet purus. Interdum et malesuada fames.";

			$care = "Hand wash only";

			$table->id();
			$table->string( 'name' );
			$table->string( 'slug' )->unique();
			$table->string( 'sku' )->unique();
			$table->text( 'description' )->default( $loremIpsum );
			$table->text( 'story' )->default( $loremIpsum );
			$table->string( 'care' )->default( $care );
			$table->string( 'materials' )->default( 'Metal, Plastic' );
			$table->integer( 'available' )->default( 0 );
			$table->integer( 'price' )->default( 0 );
			$table->string( 'image_url' )->nullable();
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'products' );
	}
}
