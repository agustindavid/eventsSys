<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiVenuesController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request,[ 'name'=>'required', 'location'=>'required', 'mincapacity'=>'required', 'maxcapacity'=>'required']);
        $newVenue = \App\models\Venue::create($request->all());
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($newVenue){
          $arr = array('msg' => 'Salon creado con exito', 'status' => true, 'cliente'=>$newVenue);
        }
        return Response()->json($arr);
    }
}
