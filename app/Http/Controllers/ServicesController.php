<?php

namespace App\Http\Controllers;

use App\models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');

        $this->middleware(['permission:servicios']);
    }

    public function index()
    {
        $services_categories=\App\models\Category::where('categorizable_type', 'services')->get();
        $services=\App\models\Service::with('categories')->get();
        return view('services.index', ['services' => $services, 'services_categories' => $services_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services_categories=\App\models\Category::where('categorizable_type', 'services')->get();
        return view('services.create', ['services_categories' => $services_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required', 'servicePrice' => 'required', 'category_id' => 'required']);
        \App\models\Service::create($request->all());
        return redirect()->route('services.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return  view('services.show',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $services_categories=\App\models\Category::where('categorizable_type', 'services')->get();
        return view('services.edit',compact('service', 'services_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->validate($request,[ 'name'=>'required', 'servicePrice'=>'required']);

        $service->update($request->all());
        return redirect()->route('services.index')->with('success','Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
