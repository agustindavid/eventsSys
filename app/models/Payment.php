<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['amount', 'payDate', 'payMethod', 'tentativeDate', 'debtAmount', 'payTotal', 'comments', 'event_id', 'user_id', 'status'];

    public function event() {
        return $this->belongsTo('App\models\Event');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
