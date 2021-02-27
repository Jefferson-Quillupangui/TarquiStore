<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $startDate = Carbon::now();
        $primerDiaMes = $startDate->firstOfMonth(); 
        $ultimoDiaMes = $startDate->endOfMonth(); 

        $order_p = DB::table('orders')
        ->select(DB::raw('count(*) as pendientes'))
        ->where('order_status_cod', '=', 'OP')
        ->first();

        $order_r = DB::table('orders')
        ->select(DB::raw('count(*) as reagendados'))
        ->where('order_status_cod', '=', 'OR')
        ->first();

        $order_e = DB::table('orders')
        ->select(DB::raw('count(*) as entregados'))
        ->where('order_status_cod','=', 'OE' ,'and' ,'delivery_date','BETWEEN', $primerDiaMes,'and' , $ultimoDiaMes)
        ->first();

        $order_c = DB::table('orders')
        ->select(DB::raw('count(*) as cancelados'))
        ->where('order_status_cod','=', 'OC' ,'and' ,'delivery_date','BETWEEN', $primerDiaMes,'and' , $ultimoDiaMes)
        ->first();
        
        return view('dash.dashboard',compact('order_p','order_r','order_e','order_c'));
    }

    public function topProduct(Request $request){
        
        $startDate = Carbon::now();
        $month = $startDate->format('m');
        $year = $startDate->format('Y');

        $product = DB::select('call sp_con_graficos(?,?,?,?)',  array("AA", "", $year , $month));

        if (empty($product)) {
            $product = 0;
        } else {
            $product = $product;
        }
        //return response()->json(['data' => $data], 200);
        //return response()->json($product, 200);
        //  return response()->json(['data' => $product], 200);

        return response(json_encode($product),200)->header('content-type','text/plaint');

    }

    public function clientesGenero(Request $request){

        $startDate = Carbon::now();
        $month = $startDate->format('m');
        $year = $startDate->format('Y');

        $clientes = DB::select('call sp_con_graficos(?,?,?,?)',  array("AB", "", $year , $month));

        if (empty($clientes)) {
            $clientes = 0;
        } else {
            $clientes = $clientes;
        }

        
        return response(json_encode($clientes),200)->header('content-type','text/plaint');
    }

    public function indexUser(){

        $startDate = Carbon::now();
        $primerDiaMes = $startDate->firstOfMonth(); 
        $ultimoDiaMes = $startDate->endOfMonth(); 
        $idUser = auth()->id();

        $order_p = DB::table('orders')
        ->select(DB::raw('count(*) as pendientes'))
        ->where('order_status_cod', '=', 'OP')
        ->where('collaborator_id', '=', $idUser)
        ->first();

        $order_r = DB::table('orders')
        ->select(DB::raw('count(*) as reagendados'))
        ->where('order_status_cod', '=', 'OR')
        ->where('collaborator_id', '=', $idUser)
        ->first();

        $order_e = DB::table('orders')
        ->select(DB::raw('count(*) as entregados'))
        ->where('collaborator_id', '=', $idUser)
        ->where('order_status_cod','=', 'OE' ,'and' ,'delivery_date','BETWEEN', $primerDiaMes,'and' , $ultimoDiaMes)
        ->first();

        $order_c = DB::table('orders')
        ->select(DB::raw('count(*) as cancelados'))
        ->where('collaborator_id', '=', $idUser)
        ->where('order_status_cod','=', 'OC' ,'and' ,'delivery_date','BETWEEN', $primerDiaMes,'and' , $ultimoDiaMes)
        ->first();

        return view('dash.dashboard',compact('order_p','order_r','order_e','order_c'));
    }
}
