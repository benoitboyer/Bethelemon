<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	
	const CREATED_AT = 'page_created_at';
    const UPDATED_AT = 'page_updated_at';
	protected $table = 'pages';
    public function categories()
    {
        return $this->hasMany('App\Category');
    }
      public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
