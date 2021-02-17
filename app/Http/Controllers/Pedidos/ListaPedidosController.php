<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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