<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:gastos']);
    }

    public function index() {
          //$payments=\App\models\Payment::all();
          //return view('payments.index', compact('payments'));
    }

    public function expensePDF($expense_id)
    {
          $expense=\App\models\Expense::with('event')->find($expense_id);
          $data=['expense'=>$expense];
          //$event = ['title' => 'Welcome to HDTuto.com'];
          //
          $pdf = PDF::loadView('expenses.expense-receipt', $data);


          return view('expenses.expense-receipt', ['expense'=>$expense]);
          //return $pdf->download('gasto'. $expense->id .'.pdf');
          //return $pdf->stream();
    }
}
