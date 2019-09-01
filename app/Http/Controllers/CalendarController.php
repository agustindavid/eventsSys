<?php

namespace App\Http\Controllers;

use App\models\Quote;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
      $this->middleware(['permission:calendario']);
    }

    public function index()
    {
        $quotes=\App\models\Quote::All();
        //$subset = $users->map->only(['id', 'name', 'email']);
        foreach($quotes as $quote){
            $quote->title = $quote->eventName;
            $quote->start = $quote->eventDate;
            $quote->end = $quote->eventFinishDate;
            $quote->url ='http://localhost:8000/quotes/'.$quote->id;
        }

        $quotes_sub = $quotes->map->only(['title', 'start', 'end', 'id', 'url']);
        return $quotes_sub;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
