<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiQuotesController extends Controller
{
    public function index() {
        $quotes=\App\models\Quote::all();
        //$subset = $users->map->only(['id', 'name', 'email']);
        foreach($quotes as $quote){
            if($quote->status==0){
                $color='#ccc';
                $url=url('/').'/quotes/'.$quote->id;
            }else{
                $color="#f5a445";
                $event=\App\models\Event::where('quote_id', $quote->id)->first();
                $url=url('/').'/events/'.$event->id;
            }
            $quote->title = $quote->eventName;
            $quote->start = $quote->eventDate;
            $quote->end = $quote->eventFinishDate;
            $quote->url =$url;
            $quote->color = $color;
        }

        $quotes_sub = $quotes->map->only(['title', 'start', 'end', 'id', 'url', 'color']);

        return $quotes_sub;
    }

    public function check_quotes($venue) {
        if($venue > 0){
            $quotes=\App\models\Quote::where('venue_id', $venue)->get();
        }else{
            $quotes=\App\models\Quote::all();
         }
        //$subset = $users->map->only(['id', 'name', 'email']);
        foreach($quotes as $quote){
            if($quote->status==0){
                $color='#ccc';
                $url=url('/').'/quotes/'.$quote->id;
            }else{
                $color="#f5a445";
                $event=\App\models\Event::where('quote_id', $quote->id)->first();
                $url=url('/').'/events/'.$event->id;
            }
            $quote->title = $quote->eventName;
            $quote->start = $quote->eventDate;
            $quote->end = $quote->eventFinishDate;
            $quote->url =$url;
            $quote->color = $color;
        }

        $quotes_sub = $quotes->map->only(['title', 'start', 'end', 'id', 'url', 'color']);

        return $quotes_sub;

    }
}
