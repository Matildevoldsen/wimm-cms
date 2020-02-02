<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts()
    {
    	return $this->hasMany('App\Article');
    }

    public function topCategory() {
        return $this->belongsTo('App\TopCategory');
    }
}
