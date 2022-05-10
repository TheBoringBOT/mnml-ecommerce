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
			$table->id();
			$table->string( 'name' );
			$table->string( 'slug' )->unique();
			$table->text( 'description' );
			$table->integer( 'available' )->default( 0 );
			$table->integer( 'price' )->default( 0 );

			// These columns are specific to events
			$table->text( 'location' )->nullable();
			$table->date( 'date' )->nullable();

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
