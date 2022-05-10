<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductFactory extends Factory {
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition() {
		$productSuffixes = [ 'Sweater', 'Pants', 'Socks', 'Glasses' ];
		$name            = $this->faker->company . ' ' . Arr::random( $productSuffixes );

		return [
			'name'        => $name,
			'slug'        => Str::slug( $name ),
			'description' => $this->faker->realText( 320 ),
			'price'       => $this->faker->numberBetween( 1000, 10000 ),
			'available'   => $this->faker->numberBetween( 5, 80 ),
			//these columns are specific to events
			'date'        => $this->faker->dateTimeBetween( '+0 days', '+1 years' ),
			'location'    => $this->faker->address,
		];
	}
}
