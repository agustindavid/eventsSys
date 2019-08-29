<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    public function store(Request $request){

        $validSlug=str_slug($request->slug);
        $request->offsetSet('slug', $validSlug);
        $newCat=\App\models\Category::create($request->all());
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($newCat){
          $arr = array('msg' => 'Categoria creada con exito', 'status' => true, 'category'=>$newCat);
        }
        return Response()->json($arr);
    }
}
