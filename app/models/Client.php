<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public $fillable = ['name','lastname', 'email', 'rfc', 'fiscalname', 'commercialname', 'phone'];
    public function quote() {
        return $this->hasMany('App\models\Quote');
    }
}
