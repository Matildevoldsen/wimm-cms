<?php

namespace WimmCMS\core\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    public function category() {
        return $this->belongsToMany('WimmCMS\core\Models\Category');
    }
}
