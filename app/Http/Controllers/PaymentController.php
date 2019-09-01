<?php

namespace App\Http\Controllers;

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
}
