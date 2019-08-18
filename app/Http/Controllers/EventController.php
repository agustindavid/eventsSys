<?php

namespace App\Http\Controllers;

use App\models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events=\App\models\Event::with('quote')->get();
        return view('events.index', ['events' => $events]);
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


        for($i=0; $i<$newEvent->receiptsQty; $i++){
            \App\models\Payment::create(array('amount' => '1000', 'payDate'=>'2019-08-22 00:00:00', 'payMethod' => 'payMethod', 'tentativeDate'=>'2019-08-22 00:00:00', 'debtAmount' => 5000, 'payTotal'=> 3000, 'comments'=>'ssddsdsds', 'event_id'=>$newEvent->id, 'user_id'=>1));
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
        //
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
