<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Package;

class ApiPackagesController extends Controller
{
    public function index()
    {
        $packages=\App\models\Package::All();
        return $packages;
    }

    public function show(Package $package)
    {
        $services=$package->services;
        //$allServices=\App\models\Service::with('packages')->get();
        $data=array('package'=>$package);
        return  $data;
    }

    public function store(Request $request)
    {
        //$this->validate($request,[ 'name'=>'required', 'kidsPrice' => 'required', 'adultPrice' => 'required']);
        //$assoc_services=;
        $newPackage=\App\models\Package::create($request->all());
        $newPackage->services()->sync($request->services);

        if($newPackage){
            $arr = array('msg' => 'Servicio creado con exito', 'status' => true, 'category'=>$newPackage);
          }
          return Response()->json($arr);
    }
}
