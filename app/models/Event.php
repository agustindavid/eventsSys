<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['quote_id', 'receiptsQty', 'extraPerson', 'deposit', 'price', 'paidTotal', 'debtAmount', 'status'];


    public function quote() {
        return $this->belongsTo('App\models\Quote', 'quote_id');
    }

    public function payments() {
        return $this->hasMany('App\models\Payment');
    }

    public function expenses() {
        return $this->hasMany('App\models\Expense');
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 1)->sum('amount');
    }

    public function services() {
        return $this->belongsToMany('App\models\Service')->withPivot('price');
    }

    //protected $appends = ['total_paid'];

    public function getTotalDebtAttribute()
    {
        $paid=$this->payments()->where('status', 1)->sum('amount');
        return $this->quote()->sum('price')-$paid;
    }

    public function getdurationAttribute()
    {
        $startTime=$this->quote->eventTime;
        $endTime=$this->quote->eventFinishTime;
        $startTime=\Carbon\Carbon::parse($startTime);
        $endTime=\Carbon\Carbon::parse($endTime);
        $duration=$endTime->diffInHours($startTime);
        return $duration;
    }

    public function getTotalSpentAttribute()
    {
        return $this->expenses()->sum('amount');
    }

    protected $appends = ['total_paid', 'total_debt', 'duration', 'total_spent'];
}
