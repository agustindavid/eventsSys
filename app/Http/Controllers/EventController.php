<?php

namespace App\Http\Controllers;

use App\models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Charts\BalanceChart;

use Barryvdh\DomPDF\Facade as PDF;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:eventos']);
    }

    public function index()
    {
        $paid=0;
        $events=\App\models\Event::with(['quote.package', 'quote.client', 'quote.venue', 'payments', 'expenses'])->get();

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
        $relatedQuote=\App\models\Quote::find($request->quote_id);
        $firstPayment=$request->firstPayment;
        $newEvent=\App\models\Event::firstOrCreate(['quote_id'=>$request->quote_id, 'receiptsQty' => $request->receiptsQty, 'extraPerson' => $request->extraPerson, 'deposit' => $request->deposit, 'price'=>$relatedQuote->price, 'paidTotal' => $request->firstPayment, 'debtAmount'=> $relatedQuote->price - $firstPayment, 'status' => 0 ]);
        $relatedQuote->status = 1;
        $relatedQuote->save();
        $carbon = new Carbon();
        $debtAmount=$relatedQuote->price - $firstPayment;
        $eachPay=$debtAmount/($newEvent->receiptsQty-1);
        $payTotal=0;
        for($i=0; $i<$newEvent->receiptsQty; $i++){
          if($i==0){
            \App\models\Payment::create(array('amount' => $firstPayment, 'payDate'=>$carbon,'payMethod' => $request->payMethod, 'tentativeDate'=>$carbon, 'debtAmount' => $debtAmount, 'payTotal'=> $firstPayment, 'comments'=>'Primer pago', 'event_id'=>$newEvent->id, 'user_id'=>1, 'status' => 1, 'toBePaid'=>0));
            $payTotal=$firstPayment;
          } else {
            $payTotal=$payTotal+$eachPay;
            \App\models\Payment::create(array('amount' => 0, 'payDate'=>null,'payMethod' => '', 'tentativeDate'=>$carbon->addMonths(1), 'debtAmount' => $debtAmount-$eachPay, 'payTotal'=> $payTotal, 'comments'=>'', 'event_id'=>$newEvent->id, 'user_id'=>1, 'status' => 0, 'toBePaid'=>$eachPay));
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
        $event = \App\models\Event::with(['quote.package', 'quote.client', 'quote.venue', 'quote.user', 'payments', 'services'])->find($event->id);
        $specialServices=\App\models\Service::where('isSpecial', 1)->get();
        $chart = new BalanceChart;
        $chart->labels(['Monto total','Total Pagado', 'Total Adeudado']);
        //$data=array();
        $eventPrice=$event->price;
        $eventPaid=\App\models\Payment::where('status', 1)->where('event_id', $event->id)->sum('amount');
        $debtTotal=$eventPrice - $eventPaid;

        $dataset=$chart->dataset('Balance', 'bar', [$eventPrice, $eventPaid, $debtTotal]);
        $dataset->backgroundColor(collect(['#060657','#060657', '#060657']));
        $dataset->color(collect(['#060657','#060657', '#060657']));

        return view('events.show', compact('event', 'specialServices', 'chart'));
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

    public function generatePDF($event_id)
    {
        $event=\App\models\Event::with('quote', 'quote.client', 'quote.venue', 'quote.categories', 'quote.package', 'quote.user', 'payments')->find($event_id);
        $data=['event'=>$event];
        //$event = ['title' => 'Welcome to HDTuto.com'];
        //
        $pdf = PDF::loadView('events.contract', $data);


        //return view('events.contract', ['event'=>$event]);
        return $pdf->download('contratoevento'. $event->id .'.pdf');
    }

    public function eventBalance(){
        $events=\App\models\Event::with(['quote.package', 'quote.client', 'quote.venue', 'payments', 'expenses'])->get();
        $chart = new BalanceChart;
        $chart->labels(['Total Cotizado','Total Aprobado', 'Total Pagado', 'Total Gastado']);
        //$data=array();
        $quotesTotal=\App\models\Quote::where('status', 0)->sum('price');
        $eventsTotal=\App\models\Quote::where('status', 1)->sum('price');
        $paidTotal=\App\models\Payment::where('status', 1)->sum('amount');
        $spentTotal=\App\models\Expense::all()->sum('amount');

        $chart->dataset('My dataset', 'bar', [$quotesTotal, $eventsTotal, $paidTotal, $spentTotal]);
        return view('events.balance', ['events' => $events, 'chart'=>$chart, 'quotesTotal'=>$quotesTotal]);

    }

    public function eventBalanceShow(Event $event){
        $event = \App\models\Event::with(['quote.package', 'quote.client', 'quote.venue', 'payments'])->find($event->id);
        return view('events.balance-detail', compact('event'));
    }
}
