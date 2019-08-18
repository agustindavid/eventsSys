<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'categorizable_type'];

    public function services() {
        return $this->hasMany('App\models\Service');
    }

    public function quotes() {
        return $this->hasMany('App\models\Quote');
    }
}
