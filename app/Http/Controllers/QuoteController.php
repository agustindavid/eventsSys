<?php

namespace App\Http\Controllers;

use App\models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
      $this->middleware('auth');
      $this->middleware(['permission:cotizaciones']);
    }

    public function index()
    {
        $quotes = \App\models\Quote::with('package', 'client', 'venue')->get();
        return view('quotes.index', ['quotes' => $quotes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allPackages=\App\models\Package::all();
        $allClients=\App\models\Client::all();
        $allVenues=\App\models\Venue::all();
        $eventsCategories=\App\models\Category::where('categorizable_type', 'quotes')->get();
        return view('quotes.create', ['allPackages' => $allPackages, 'allClients' => $allClients, 'allVenues'=> $allVenues, 'eventsCategories'=>$eventsCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newQuote=\App\models\Quote::create($request->all());
        return redirect()->route('quotes.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //$client=$quote->client;

        return  view('quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
