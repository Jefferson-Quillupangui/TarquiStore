<?php

namespace App\Http\Controllers\Comisiones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comission;
use App\Models\Collaborator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Classes\ComisionesClass;

class ComisionesController extends Controller
{

     // select DISTINCT YEAR(delivery_date) from orders
    

     
    public function index(){
        $name = Auth::user()->name; 
        $anios_obtenidos_orden= DB::select('select DISTINCT YEAR(delivery_date) AS anio from orders');
        return view('comision.index', compact('name' , 'anios_obtenidos_orden'));
    }

    public function verComisiones( Request $request){
       
        $comisionesClass =  new ComisionesClass();
        $user_id = $request->user_id;
        $anio = $request->anio;
       $comi = array();

        for ($meses = 1; $meses <= 12; $meses++) {
            
            switch ($meses) {
                case 1:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Enero', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 2:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Febrero', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 3:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Marzo', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 4:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Abril', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 5:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Mayo' ,$user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 6:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Junio', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 7:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Julio', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 8:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Agosto', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 9:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Septiembre', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 10:
                    $jsonIndex = $comisionesClass->arregloComision($meses,  'Octubre', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 11:
                    $jsonIndex = $comisionesClass->arregloComision($meses, 'Noviembre', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                case 12:
                    $jsonIndex = $comisionesClass->arregloComision($meses,  'Diciembre', $user_id, $anio);
                    array_push($comi, $jsonIndex);
                    
                    break;
                // default:
                // echo "Your favorite color is neither red, blue, nor green!";
            }
        }  
        
        return response()->json(['data' => $comi], 200);
      
        
    }

    /**
     * Lista en formato Json de los colaboradores
     */
    public function verListaColaboradores(){

        $collaborators = Collaborator::join("users AS b","collaborators.user_id","=","b.id")
        ->select(
            'collaborators.user_id',
            'collaborators.identification',
            'collaborators.name',
            'b.email',
            'collaborators.phone'
                )
            ->where('collaborators.status','=','A')
            ->get();
        return response()->json(['data' => $collaborators], 200);
    }

    
    // public function consultaComisiones($mes){
    //     $comission = DB::table('comissions')
    //     ->where('collaborator_id', '=', 1)
    //     ->where('year', '=', 2021)
    //     ->where('month', '=', $mes)
    //     ->select('total_comission','month_start_date','month_end_date','quantity_orders','month','year')
    //     ->first();

    //     return $comission;
    // }
}