<?php

namespace App\Http\Controllers;

use App\models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paid=0;
        $events=\App\models\Event::with(['quote.package', 'quote.client', 'quote.venue', 'payments'])->get();

        return view('events.index', ['events' => $events, 'paid' => $paid]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newEvent=\App\models\Event::firstOrCreate(['quote_id'=>$request->quote_id], ['receiptsQty' => $request->receiptsQty]);
        $firstPayment=$request->firstPayment;
        $carbon = new Carbon();
        $relatedQuote=\App\models\Quote::find($newEvent->quote_id);
        $debtAmount=$relatedQuote->price - $firstPayment;
        $eachPay=$debtAmount/($newEvent->receiptsQty-1);
        $payTotal=0;
        for($i=0; $i<$newEvent->receiptsQty; $i++){
          if($i==0){
            \App\models\Payment::create(array('amount' => $firstPayment, 'payDate'=>$carbon,' payMethod' => '', 'tentativeDate'=>$carbon, 'debtAmount' => $debtAmount, 'payTotal'=> $firstPayment, 'comments'=>'Primer pago', 'event_id'=>$newEvent->id, 'user_id'=>1, 'status' => 1));
            $payTotal=$firstPayment;
          } else {
            $payTotal=$payTotal+$eachPay;
            \App\models\Payment::create(array('amount' => $eachPay, 'payDate'=>null,'payMethod' => '', 'tentativeDate'=>$carbon->addMonths(1), 'debtAmount' => $debtAmount-$eachPay, 'payTotal'=> $payTotal, 'comments'=>'', 'event_id'=>$newEvent->id, 'user_id'=>1, 'status' => 0));
            $debtAmount=$debtAmount-$eachPay;
          }
        }
        return redirect()->route('events.index')->with('success','Registro creado satisfactoriamente');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event = \App\models\Event::with(['quote.package', 'quote.client', 'quote.venue', 'payments'])->find($event->id);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
