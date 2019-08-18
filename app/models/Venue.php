<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = ['name', 'location', 'mincapacity', 'maxcapacity'];

    public function quote() {
      return $this->hasMany('App\models\Quote');
    }
}
