<?php

namespace App\Http\Controllers;

use App\models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allServices=\App\models\Service::all();
        $packages=\App\models\Package::All();
        return view('packages.index', ['packages' => $packages, 'allServices'=>$allServices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allServices=\App\models\Service::all();
        return view('packages.create', compact('allServices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required', 'kidsPrice' => 'required', 'adultPrice' => 'required']);
        //$assoc_services=;
        $newPackage=\App\models\Package::create($request->all());
        $newPackage->services()->sync($request->services);
        return redirect()->route('packages.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        $services=$package->services;
        $allServices=\App\models\Service::with('packages')->get();
        return  view('packages.show',compact(['package', 'services', 'allServices']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $services=$package->services;
        $allServices=\App\models\Service::with('packages')->get();
        return view('packages.edit',compact('package', 'allServices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $this->validate($request,[ 'name'=>'required', 'price'=>'required']);

        print_r($request->services);
        $package->services()->sync($request->services);
        $package->update($request->all());
        return redirect()->route('packages.index')->with('success','Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
