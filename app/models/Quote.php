<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['parent_id', 'eventName', 'eventDate', 'eventTime', 'eventFinishDate', 'eventFinishTime', 'price', 'status', 'peopleQty', 'validThru', 'receiptsQty', 'user_id', 'venue_id', 'package_id', 'client_id', 'category_id', 'adultsQty', 'kidsQty', 'extras', 'extrasPrice', 'discount'];

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

    public function getPackagePriceAttribute()
    {
        $kidsTotal=($this->package->kidsPrice)*($this->kidsQty);
        $adultsTotal=($this->package->adultPrice)*($this->adultsQty);
        $packagePrice=$kidsTotal+$adultsTotal;
        return $packagePrice;
    }

    public function getFinalPriceAttribute()
    {
        $kidsTotal=($this->package->kidsPrice)*($this->kidsQty);
        $adultsTotal=($this->package->adultPrice)*($this->adultsQty);
        $packagePrice=$kidsTotal+$adultsTotal;
        $packageDiscount=($this->discount * $packagePrice)/100;
        $finalPrice=$packagePrice - $packageDiscount;
        return $finalPrice;
    }

    public function getExtrasSumAttribute()
    {
        $extraServices=$this->services;
        $extraServicesTotal=0;
        foreach($extraServices as $service){
            $extraServicesTotal += $service->pivot->price;
        }
        return $extraServicesTotal;
    }

    protected $appends = ['package_price', 'final_price', 'extras_sum'];

}
