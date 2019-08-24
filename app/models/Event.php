<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['quote_id', 'receiptsQty'];


    public function quote() {
        return $this->belongsTo('App\models\Quote', 'quote_id');
    }

    public function payments() {
        return $this->hasMany('App\models\Payment');
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 1)->sum('amount');
    }

    protected $appends = ['total_paid'];
}
