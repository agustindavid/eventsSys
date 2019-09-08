<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['parent_id', 'eventName', 'eventDate', 'eventTime', 'eventFinishDate', 'eventFinishTime', 'price', 'status', 'peopleQty', 'validThru', 'receiptsQty', 'user_id', 'venue_id', 'package_id', 'client_id', 'category_id', 'adultsQty', 'kidsQty', 'extras', 'extrasPrice'];

    public function categories() {
        return $this->belongsTo('App\models\Category', 'category_id');
    }

    public function client() {
        return $this->belongsTo('App\models\Client');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function package() {
        return $this->belongsTo('App\models\Package');
    }

    public function venue() {
        return $this->belongsTo('App\models\Venue');
    }

    public function services() {
        return $this->belongsToMany('App\models\Service')->withPivot('price');
    }

    public function event() {
        return $this->hasOne('App\models\Event');
    }

}
