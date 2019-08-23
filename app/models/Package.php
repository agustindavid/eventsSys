<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'price', 'kidsPrice', 'adultPrice'];

    public function services(){
      return $this->belongsToMany('App\models\Service');
    }

    public function quote() {
      return $this->hasMany('App\models\Quote');
    }
}
