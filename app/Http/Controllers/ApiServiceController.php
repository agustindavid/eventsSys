<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
    public function store(Request $request)
    {
        //$this->validate($request,[ 'name'=>'required', 'servicePrice' => 'required', 'category_id' => 'required']);
        $newService=\App\models\Service::create($request->all());
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($newService){
          $arr = array('msg' => 'Servicio creado con exito', 'status' => true, 'category'=>$newService);
        }
        return Response()->json($arr);
    }
}
