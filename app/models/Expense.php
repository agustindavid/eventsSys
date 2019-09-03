<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['amount', 'expenseDate', 'concept', 'event_id', 'receipt'];

    public function event() {
        return $this->belongsTo('App\models\Event');
    }

}
