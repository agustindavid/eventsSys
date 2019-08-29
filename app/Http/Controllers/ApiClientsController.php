<?php

namespace App\Http\Controllers;

use App\models\Client;
use App\models\Quote;
use Illuminate\Http\Request;

class ApiClientsController extends Controller
{

    public function index(){
        $clients=\App\models\Client::All();
        return $clients;
    }

    public function show(Client $client){
        $quotes=\App\models\Quote::where('client_id', $client->id)->with('package')->get();
        //$clients=\App\models\Client::All();
        return $quotes;
    }

    public function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'rfc'=>'required', 'fiscalname'=>'required', 'commercialname'=>'required', 'phone'=>'required']);
        $newClient=\App\models\Client::create($request->all());
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($newClient){
        $arr = array('msg' => 'Cliente creado con exito', 'status' => true, 'cliente'=>$newClient);
        }
        return Response()->json($arr);

    }
}
