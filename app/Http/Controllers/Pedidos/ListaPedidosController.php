<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ListaPedidosController extends Controller
{
    public function index(){
        $name = Auth::user()->name; 

       $orderStatus = OrderStatus::all();
       
       return view('pedido.show', compact('name', 'orderStatus'));
    }



    public function listaRevisionOrders_json(){
         

        $id = Auth::user()->id;
        $name = Auth::user()->name;
        
        if( $id == 1 || $name == "Admin"){
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
                'g.email AS email_cliente')
                ->get();
                return response()->json(['data' => $orders], 200);
        }else{
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
                ->where('orders.collaborator_id','=',$id )
                ->get();
                return response()->json(['data' => $orders], 200);
        }
       
    }


    public function ListaDetalleOrders_json(Request $request ){
        $v_id_orden = $request->id_orden;
     
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
        ->where('order_product.order_id','=',$v_id_orden ) 
        ->where('a.id','=',$v_id_orden)
        ->get();
        return response()->json(['data' => $detalle_orders], 200);
    }


    public function buscarFiltrandoOrdenes( Request $request){
         
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        
        $order_status_cod = $request->estadoOrden;
        $fechaDesde = $request->fechaDesde;
        $fechaHasta = $request->fechaHasta;
           
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
            'g.email AS email_cliente')
            ->where('orders.order_status_cod','=',$order_status_cod ,'and' ,'orders.delivery_date','BETWEEN', $fechaDesde,'and' , $fechaHasta )
            //->orWhereBetween('orders.delivery_date', [$fechaDesde, $fechaHasta]) column_name BETWEEN value1 AND value2;
            ->get();
            return response()->json(['data' => $orders], 200);
        
        // if( $id == 1 || $name == "Admin"){
        // }else{
        // }
       
    }

    
  

 
}