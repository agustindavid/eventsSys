<?php

namespace App\Http\Controllers;

use App\models\Client;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
      $this->middleware('auth');
      $this->middleware(['permission:clientes']);
    }

    public function index()
    {
        //$user=Auth::user();
        //print_r($user);
        //$user->assignRole('writer');
        $clients=\App\models\Client::All();
        return view('clients.index', ['clients' => $clients]);
        //return $clients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'rfc'=>'required', 'fiscalname'=>'required', 'commercialname'=>'required', 'phone'=>'required']);
        \App\models\Client::create($request->all());
        return redirect()->route('clients.index')->with('success','Registro creado satisfactoriamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {

        $events = \App\models\Event::whereHas('quote', function($query) use ($client) {
            $query->where('client_id', $client->id);
        })->with('quote.package', 'quote.venue', 'payments')->get();
        //$clientEvents=\App\models\Event::where('client_id', $client->id)->where('status', 1)->get();
        return  view('clients.show',compact(['client', 'events']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'rfc'=>'required', 'fiscalname'=>'required', 'commercialname'=>'required', 'phone'=>'required']);

        $client->update($request->all());
        return redirect()->route('clients.index')->with('success','Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
