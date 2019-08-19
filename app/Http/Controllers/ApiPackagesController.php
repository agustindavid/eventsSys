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
        $data=array('package'=>$package, 'services' => $services);
        return  $data;
    }
}
