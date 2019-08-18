<?php

namespace App\Http\Controllers;

use App\models\Venue;
use Illuminate\Http\Request;

class VenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues=\App\models\Venue::All();
        return view('venues.index', ['venues' => $venues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required', 'location'=>'required', 'mincapacity'=>'required', 'maxcapacity'=>'required']);
        \App\models\Venue::create($request->all());
        return redirect()->route('venues.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venues  $venues
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        return  view('venues.show',compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venues  $venues
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        return view('venues.edit',compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venues  $venues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        $this->validate($request,[ 'name'=>'required', 'location'=>'required', 'mincapacity'=>'required', 'maxcapacity'=>'required']);

        $venue->update($request->all());
        return redirect()->route('venues.index')->with('success','Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venues  $venues
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venues $venues)
    {
        //
    }
}
