<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Service extends Model
{
    protected $fillable = ['name', 'servicePrice', 'category_id'];

    public function categories() {
        return $this->belongsTo('App\models\Category', 'category_id');
    }

    public function packages() {
        return $this->belongsToMany('App\models\Package');
    }

    public function quotes() {
        return $this->belongsToMany('App\models\Quote')->withPivot('price');
    }
}
