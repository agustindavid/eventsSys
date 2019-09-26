<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDiscountsController extends Controller
{
    public function check_discount($date){
        $date=str_replace("-","/",$date);
        $day=\Carbon\Carbon::parse($date)->locale('es')->isoFormat('dddd');
        $month=\Carbon\Carbon::parse($date)->locale('es')->isoFormat('MMMM');

            if($day=='viernes' || $day=='sábado' || $day=='domingo'){
                $day=str_slug($day);
                $month=str_slug($month);
                $maxDiscount=settings($month.'_'.$day);
                $arr = array('msg' => 'Cliente creado con exito', 'status' => true, 'maxDiscount'=>$maxDiscount);
                return Response()->json($arr);
            } else {

            }
    }
}
