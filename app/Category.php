<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public static $messages=[
		'name.required' => 'Debe ingresar un nombre.',
		'name.min' => 'Debe ingresar minimo 6 caracteres.',
		'description.required' => 'Debe ingresar una descripción.',
		'description.max' => 'No debe exceder los 100 caracteres.'   		
	];


	public static $rules=[
		'name'=> 'required|min:6',
		'description'=> 'required|max:100'
	];
	
	protected $fillable = ['name', 'description'];

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute(){
    	if ($this->image) 
    		return '/images/categories/'.$this->image;
    	
    	//else
    	$firstProduct = $this->products()->first();
    	if ($firstProduct) 
    		return $firstProduct->featured_image_url;	
    	
    	return '/images/default.png';
    }
}
