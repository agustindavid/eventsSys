<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        $payments=\App\models\Payment::all();
        return view('payments.index', compact('payments'));
    }
}
