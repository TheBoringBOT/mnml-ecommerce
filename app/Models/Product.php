<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BinaryCats\Sku\HasSku;

use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model {
	use HasFactory, HasSku, Sluggable;

	protected $guarded = [];

	public function categories() {
		return $this->belongsToMany( Category::class );
	}

	public function orders() {
		return $this->belongsToMany( Order::class );
	}

	public function images() {
		return $this->hasMany( ProductImage::class );
	}

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable(): array {
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
}
