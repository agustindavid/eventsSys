<?php

namespace App\Http\Controllers;

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
}
