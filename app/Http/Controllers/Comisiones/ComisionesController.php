<?php

namespace App\Http\Controllers\Comisiones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comission;

use Illuminate\Support\Facades\DB;

class ComisionesController extends Controller
{
    public function index(){
        return view('comision.index');
    }

    public function verComisiones(){
       
        //$objeto = new stdClass();

        $comi = array();

        $rpt = "";
        for ($meses = 1; $meses <= 12; $meses++) {
            
            switch ($meses) {
                case 1:
                    $rpt = $this->consultaComisiones($meses);
                    if($rpt == null){
                        $arregloIndexado = array('total_comission'=>0,
                                                'month_start_date'=>"2021-01-01",
                                                'month_end_date'=>"2021-01-30",
                                                'quantity_orders'=>0,
                                                'month'=>$meses,
                                                'year'=>2021);
                        	
                        array_push($comi, json_encode($arregloIndexado));
                    }
                    
                break;
                case 2:
                    $rpt = $this->consultaComisiones($meses);
                    if($rpt == null){
                        dd($rpt);
                    }else{
                        $arregloIndexado = array('total_comission'=>$rpt->total_comission ,
                        'month_start_date'=> $rpt->month_start_date  ,
                        'month_end_date'=> $rpt->month_end_date ,
                        'quantity_orders'=> $rpt->quantity_orders ,
                        'month'=> $rpt->month ,
                        'year'=> $rpt->year );
    
array_push($comi, json_encode($arregloIndexado));
                    }
                break;
                // case 3:
                // break;
                // case 4:
                // break;
                // case 5:
                // break;
                // case 6:
                // break;
                // case 7:
                // break;
                // case 8:
                // break;
                // case 9:
                // break;
                // case 10:
                // break;
                // case 11:
                // break;
                // case 11:
                // break;
                // default:
                // echo "Your favorite color is neither red, blue, nor green!";
            }
        }  
        
        return dd($comi);
        // $comission = Comission::
        // where('collaborator_id', '=', 2)
        // ->where('year', '=', 2021)
        // ->where('month', '=', 2)
        // //->pluck('total_comission','month_start_date','month_end_date','quantity_orders','month','year');
        // ->first();
            
       
        
    }

    public function consultaComisiones($mes){
        $comission = DB::table('comissions')
        ->where('collaborator_id', '=', 1)
        ->where('year', '=', 2021)
        ->where('month', '=', $mes)
        ->select('total_comission','month_start_date','month_end_date','quantity_orders','month','year')
        ->first();

        return $comission;
    }
}