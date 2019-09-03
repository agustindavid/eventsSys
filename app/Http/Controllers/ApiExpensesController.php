<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiExpensesController extends Controller
{
    public function store(Request $request)
    {
        //$this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'rfc'=>'required', 'fiscalname'=>'required', 'commercialname'=>'required', 'phone'=>'required']);
        $newExpense=\App\models\Expense::create($request->all());
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($newExpense){
        $arr = array('msg' => 'Pago agregado con exito', 'status' => true, 'expense'=>$newExpense);
        }
        return Response()->json($arr);
    }
}
