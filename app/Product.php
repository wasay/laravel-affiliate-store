<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
  use SoftDeletes, Sluggable;

  protected $fillable = [
    'name',
    'link',
    'price',
    'main_image',
    'category_id',
    'brands_id',
    'slug',
    'type'
  ];

  protected $dates = ['deleted_at'];

  public function category(){
    return $this->belongsToMany('App\Category');
  }

  public function brands(){
    return $this->belongsTo('App\Brand');
  }

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
}
