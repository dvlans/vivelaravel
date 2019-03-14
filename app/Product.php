<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function images(){
    	return $this->hasMany(ProductImage::class);
    }

    protected $fillable = ['name', 'description', 'price', 'category', 'long_description'];


    public function getFeaturedImageUrlAttribute(){
    	$featuredImage = $this->images()->where('featured', true)->first();
    	if (!$featuredImage) 
    		$featuredImage = $this->images()->first();
    	
    	if ($featuredImage) {
    		return $featuredImage->url;
    	}

    	//default

    	return '/images/products/default.png';
    }


    public function getCategoryNameAttribute(){
        if ($this->category) {
            return $this->category->name;
        }else{
            return 'General';
        }

    }

    public static function boot() {
        parent::boot();

        static::deleting(function($product) { // before delete() method call this
             $product->images()->delete();
             // do the rest of the cleanup...
        });
    }
}
