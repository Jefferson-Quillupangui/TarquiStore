<?php

namespace App\Http\Controllers\Reportes;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{
   
    public function PDF(){
        $pdf = PDF::loadView('pdfReport.orden');
        return $pdf->stream('orden.pdf');///download descargar directo   ///stream   previsulizar antes de desdarcagar
      
    }


    public function OrdenPDF(Request $request){
        //$id){

            $id = $request->txt_id_cab_orden;
           
        $orders = Order::join("sectors AS b","orders.sector_cod","=","b.codigo")
        ->join("city_sales AS c","orders.city_sale_cod","=","c.codigo")
        ->join("order_statuses AS d","orders.order_status_cod","=","d.codigo")
        ->join("collaborators AS e","orders.collaborator_id","=","e.id")
        ->join("clients AS f","orders.client_id","=","f.id")
        ->join("users AS g","orders.collaborator_id","=","g.id")
        ->select(
            'orders.id',
            'orders.delivery_date',
            'orders.delivery_time',
            'orders.delivery_address',
            'orders.total_order',
            'orders.total_comission',
            'orders.observation',
            'orders.status_comission',
            'orders.sector_cod',
            'orders.city_sale_cod',
            'orders.client_id',
            'orders.collaborator_id',
            'orders.order_status_cod',
            'b.name AS nombre_sector',
            'c.name AS nombre_ciudad',
            'd.name AS nombre_estado_ord',
            'e.identification',
            'e.name AS nombre_colaborador',
            'f.phone1' ,
            'f.phone2',
            'f.email',
            'f.identification',
            'f.name AS nombre_cliente',
            'g.name AS nombre_usuario',
            'g.email AS email_cliente'
                 )
          ->where('orders.id','=',$id )
        ->first();


        $detalle_orders = DB::table('order_product')
        ->join('orders AS a', 'order_product.order_id', '=', 'a.id')
        ->join('products AS b', 'order_product.product_id', '=', 'b.id')
        ->select(
            'order_product.id_detalle_product',
            'order_product.order_id',
            'order_product.product_id',
            'order_product.name_product',
            'order_product.quantity',
            'order_product.price',
            'order_product.discount_porcentage',
            'order_product.price_discount',
            'order_product.total_line',
            'order_product.comission',
            'order_product.total_comission'
                 )
        ->where('order_product.order_id','=',$id ) 
        ->get();
  
       // return response()->json(['data' => $orders]);
        $pdf = PDF::loadView('pdfReport.orden', compact('orders','detalle_orders'));
         return $pdf->download('000'.$id.'_orden.pdf');///download descargar directo   ///stream   previsulizar antes de desdarcagar
       
    }


    public function ordenDatosPDF(Request $request){

        $estado = $request->id;
        dd($estado );
        //   $pdf = PDF::loadView('pdfReport.orden');//, compact('estado')
        //   return $pdf->stream('orden.pdf');///download descargar directo   ///stream   previsulizar antes de desdarcagar
      
    }
}