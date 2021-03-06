<?php

namespace App\Http\Controllers;

use App\models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ApiPaymentController extends Controller
{
    public function store(Request $request)
    {
        //$this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'rfc'=>'required', 'fiscalname'=>'required', 'commercialname'=>'required', 'phone'=>'required']);
        $request->request->add(['status' => 1]);
        $newPayment=\App\models\Payment::create($request->all());
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($newPayment){
        $arr = array('msg' => 'Pago agregado con exito', 'status' => true, 'payment'=>$newPayment);
        }
        return Response()->json($arr);
    }

    public function show(Payment $payment){
        return $payment;
    }

    public function update(Request $request,  Payment $payment)
    {
        $prevPayment_id=\App\models\Payment::where('event_id', $payment->event_id)->where('status', 1)->where('id', '<', $payment->id)->max('id');
        $prevPayment=\App\models\Payment::find($prevPayment_id);
        $debtAmount=$prevPayment->debtAmount - $request->amount;
        $payTotal=$prevPayment->payTotal+$request->amount;
        if($request->amount < $payment->toBePaid){
          $payment->update(array('amount' => $request->amount, 'payDate'=>$request->payDate, 'payMethod' => $request->payMethod, 'debtAmount' => $debtAmount, 'payTotal'=> $payTotal, 'comments'=>$request->comments, 'user_id'=>$request->user_id, 'status' => 1));
          $remaing=$payment->toBePaid-$request->amount;
          $newPayment=\App\models\Payment::create(array('amount' => 0, 'payDate'=>null, 'payMethod' => $request->payMethod,'tentativeDate'=>$payment->tentativeDate, 'debtAmount' => $debtAmount-$request->amount, 'payTotal'=> $payTotal, 'comments'=>'', 'event_id'=>$payment->event_id, 'user_id'=>1, 'status' => 0, 'toBePaid'=>$remaing));
        } else if ($request->amount > $payment->toBePaid){
          $payment->update(array('amount' => $request->amount, 'payDate'=>$request->payDate, 'payMethod' => $request->payMethod, 'debtAmount' => $debtAmount, 'payTotal'=> $payTotal, 'comments'=>$request->comments, 'user_id'=>$request->user_id, 'status' => 1));
          $debtAmount=$payment->debtAmount;
          $missingPayments=\App\models\Payment::where('status', 0)->where('event_id', $payment->event_id)->get();
          echo count($missingPayments);
            foreach($missingPayments as $missingPayment){
              $missingPayment->update(array('toBePaid' => $debtAmount/count($missingPayments)));
            }
        } else {
          $payment->update(array('amount' => $request->amount, 'payDate'=>$request->payDate, 'payMethod' => $request->payMethod, 'debtAmount' => $debtAmount, 'payTotal'=> $payTotal, 'comments'=>$request->comments, 'user_id'=>$request->user_id, 'status' => 1));
        }
    }

    public function addCharge(Request $request) {
          $carbon = new Carbon();
            $event=\App\models\Event::find($request->event_id);
            $totalPaid=$event->total_paid;
            $debtAmount=($event->quote->price-$totalPaid) + $request->amount;
            $request->request->add(['status' => 0]);
            //$newPayment=\App\models\Payment::create($request->all());
            $newPayment=\App\models\Payment::create(array('amount' => $request->amount, 'payDate'=>$carbon,'payMethod' => NULL, 'tentativeDate'=>$carbon, 'debtAmount' => $debtAmount, 'payTotal'=> $totalPaid, 'comments'=>'Cargo Extra', 'event_id'=>$event->id, 'user_id'=>$request->user_id, 'status' => 0, 'toBePaid'=>$request->amount));
            $actualPrice=$event->price;
            $newPrice=$actualPrice + $request->amount;
            $event->update(array('price' => $newPrice));
            foreach($request->services as $s_service){
                //$requestIndex='servicePrice-'.$s_service;
                $event->services()->syncWithoutDetaching([$s_service[0]=>['price'=>$s_service[1]]]);
            }
            //print_r($request->all());
    }
}
