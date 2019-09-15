<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public $fillable = ['name','lastname', 'email', 'rfc', 'fiscalname', 'commercialname', 'phone', 'mobilePhone', 'number', 'interiorNumber', 'street', 'colony', 'city', 'state', 'postalCode', 'dni', 'dniType'];
    public function quote() {
        return $this->hasMany('App\models\Quote');
    }
}
