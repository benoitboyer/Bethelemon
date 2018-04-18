<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
     
    public function page()
    {
        return $this->belongsTo('App\Page');
    }
    
    
    public function posts(){
		return $this->hasMany('App\Post');
	}	
}
