<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;


class MisReportesController extends Controller
{
    public function index(){
        $anios_obtenidos_orden= DB::select('select DISTINCT YEAR(delivery_date) AS anio from orders');
        return view('reportes.index', compact( 'anios_obtenidos_orden'));
    }

    public function ComprasPorCliente(Request $request){
        
        $opcion = $request->opcion;
        $mes = $request->mes;
        $anio = $request->anio;
        $estado_orden = "OE";//$request->estado;


        $data = DB::select('call sp_con_reportes(?,?,?,?,?)',  array($opcion, $mes, $anio, $estado_orden, ""));

        if (empty($data)) {
            $data = 0;
        } else {
            $data = $data;
        }
        //return response()->json(['data' => $data], 200);
        return response()->json($data, 200);
       
    }

    public function VentasPorVendedor(Request $request){
        
        $opcion = $request->opcion;
        $mes = $request->mes;
        $anio = $request->anio;
        $estado_orden = "OE";//$request->estado;


        $data = DB::select('call sp_con_reportes(?,?,?,?,?)',  array($opcion, $mes, $anio, $estado_orden, ""));

        if (empty($data)) {
            $data = 0;
        } else {
            $data = $data;
        }
        //return response()->json(['data' => $data], 200);
        return response()->json($data, 200);
       
    }

    public function ListaProductosVendidos(Request $request){
        
        $opcion = $request->opcion;
        $mes = $request->mes;
        $anio = $request->anio;
        $estado_orden = "OE";//$request->estado;


        $data = DB::select('call sp_con_reportes(?,?,?,?,?)',  array($opcion, $mes, $anio, $estado_orden, ""));

        if (empty($data)) {
            $data = 0;
        } else {
            $data = $data;
        }
        //return response()->json(['data' => $data], 200);
        return response()->json($data, 200);
       
    }

    public function VentasDiariasxMes(Request $request){
        
        $opcion = $request->opcion;
        $mes = $request->mes;
        $anio = $request->anio;
        $estado_orden = "OE";//$request->estado;


        $data = DB::select('call sp_con_reportes(?,?,?,?,?)',  array($opcion, $mes, $anio, $estado_orden, ""));

        if (empty($data)) {
            $data = 0;
        } else {
            $data = $data;
        }
        //return response()->json(['data' => $data], 200);
        return response()->json($data, 200);
       
    }

    public function VentasPorCategoria(Request $request){
        
        $opcion = $request->opcion;
        $mes = $request->mes;
        $anio = $request->anio;
        $estado_orden = "OE";//$request->estado;


        $data = DB::select('call sp_con_reportes(?,?,?,?,?)',  array($opcion, $mes, $anio, $estado_orden, ""));

        if (empty($data)) {
            $data = 0;
        } else {
            $data = $data;
        }
        //return response()->json(['data' => $data], 200);
        return response()->json($data, 200);
       
    }

    public function PedidosEntregados(Request $request){
        
        $opcion = $request->opcion;
        $mes = $request->mes;
        $anio = $request->anio;
        $estado_orden = "OE";//$request->estado;


        $data = DB::select('call sp_con_reportes(?,?,?,?,?)',  array($opcion, $mes, $anio, $estado_orden, ""));

        if (empty($data)) {
            $data = 0;
        } else {
            $data = $data;
        }
        //return response()->json(['data' => $data], 200);
        return response()->json($data, 200);
       
    }
    

    public function ReportesPdf(Request $request){
        
        $opcion = "AE";
        $mes = "02";
        $anio = "2021";
        $estado_orden = "OE";//$request->estado;


        $data = DB::select('call sp_con_reportes(?,?,?,?,?)',  array($opcion, $mes, $anio, $estado_orden, ""));

      
           $pdf = PDF::loadView('pdfReport.ventasPorCategoria', compact( 'data' ));
           return $pdf->stream('ReportesPorVentas.pdf');


     
    }

    
    
    
}