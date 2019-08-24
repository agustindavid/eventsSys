<?php

namespace App\Http\Controllers;

use App\models\Payment;
use Illuminate\Http\Request;

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

    public function update(Request $request,  Payment $payment){
        $prevPayment=\App\models\Payment::where('event_id', $payment->event_id)->where('status', 1)->where('id', '<', $payment->id)->max('id');
        $prevPayment=\App\models\Payment::find($prevPayment);
        $debtAmount=$prevPayment->debtAmount - $request->amount;
        $payTotal=$prevPayment->payTotal+$request->amount;
        //print_r($prevPayment);
        $payment->update(array('amount' => $request->amount, 'payDate'=>$request->payDate, 'payMethod' => $request->payMethod, 'debtAmount' => $debtAmount, 'payTotal'=> $payTotal, 'comments'=>$request->comments, 'user_id'=>$request->user_id, 'status' => 1));
    }
}
