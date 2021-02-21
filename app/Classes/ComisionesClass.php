<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
//use App\Models\Order;


class ComisionesClass 
{
    public function fechaInicioMes($mes, $anio ){
          
       // $fecha="2021-01-01";//$fechaIngresoPedido;

        
        // $anio = date("Y", strtotime($fecha)); 
        // $mes = date("m", strtotime($fecha)); 
        $month     = $anio.'-'.$mes  ;
        
        $aux1         = date('Y-m-d', strtotime("{$month} + 1 month"));
        $start_day = date('Y-m-01', strtotime("{$aux1} -  1 day"));

        return $start_day;

    }
    
    public function fechaFinMes($mes, $anio){
        
        // $fecha="2021-01-01";//$fechaIngresoPedido;

        
        // $anio = date("Y", strtotime($fecha)); 
        // $mes = date("m", strtotime($fecha)); 
       
        // //fecha fin de mes
        $month     = $anio.'-'.$mes  ;
        $aux         = date('Y-m-d', strtotime("{$month} + 1 month"));
        $last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));

        return $last_day;
        
    }


    public function arregloComision($meses, $mesDescription, $user_id, $anio){
        //$comi = array();
        $rpt = self::consultaComisiones($meses, $user_id, $anio);
        if($rpt == null){
            $arregloIndexado = array('total_comission'=>0.00,
                                'month_start_date'=>self::fechaFinMes($meses, $anio),
                                'month_end_date'=>self::fechaFinMes($meses, $anio),
                                'quantity_orders'=>0,
                                'month'=>$meses,
                                'mesDescription'=> $mesDescription,
                                'year'=>$anio);
                        	
            return $arregloIndexado;
        }else{
            $arregloIndexado = array('total_comission'=>$rpt->total_comission ,
                    'month_start_date'=> $rpt->month_start_date  ,
                    'month_end_date'=> $rpt->month_end_date ,
                    'quantity_orders'=> $rpt->quantity_orders ,
                    'month'=> $rpt->month ,
                    'mesDescription'=> $mesDescription,
                    'year'=> $rpt->year );
                    
            return $arregloIndexado;
        }
        
        
    }


    public function consultaComisiones($mes, $user_id, $anio){
        
        $comission = DB::table('comissions')
        ->where('collaborator_id', '=',$user_id)
        ->where('year', '=', $anio)
        ->where('month', '=', $mes)
        ->select('total_comission','month_start_date','month_end_date','quantity_orders','month','year')
        ->first();

        return $comission;
    }
}