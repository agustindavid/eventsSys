<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
      $this->middleware(['permission:pagos']);
    }

    public function index() {
        $payments=\App\models\Payment::all();
        return view('payments.index', compact('payments'));
    }

    public function paymentPDF($payment_id)
    {
        $payment=\App\models\Payment::with('event', 'event.quote', 'event.quote.client')->find($payment_id);
        $data=['payment'=>$payment];
        //$event = ['title' => 'Welcome to HDTuto.com'];
        //
        $pdf = PDF::loadView('payments.payment-receipt', $data);


        //return view('payments.payment-receipt', ['payment'=>$payment]);
        return $pdf->download('pago'. $payment->id .'.pdf');
        //return $pdf->stream();
    }
}
