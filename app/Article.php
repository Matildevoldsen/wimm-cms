<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $appends = ['category'];
    
    public function getCategoryAttribute()
    {
            return Category::find($this->id);
    }
    


    public function category()
    {
    	return $this->belongsToMany('App\Category');
    }
}
