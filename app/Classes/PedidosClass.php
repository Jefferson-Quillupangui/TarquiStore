<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use App\Models\Order;


class PedidosClass 
{
    /**
     * Egreso de inventario (Salida) Resta inventario 
     */
    public static function Egreso_inventario($p_in_product_id, $p_in_quantity){
        
        DB::beginTransaction();
          
        try{
            $cantidad_actual;
            $product_quantity = DB::table('products')->where('id',$p_in_product_id )->pluck('quantity');

            foreach ($product_quantity as $key => $object) {
                $cantidad_actual  = $object;
            }
        
        
            $inventario = DB::table('products')
            ->where('id', $p_in_product_id )
            ->update(['quantity' => ($cantidad_actual - $p_in_quantity) ,
                    'updated_at' => now() ]);
                    $inventario =  DB::commit();
           // return 1 ;
        } catch (\Exception $ex) {
                 // $queries = DB::getQueryLog();
                 // echo $ex->getMessage();
                 DB::rollback();
                 return response()->json(['data' =>$ex->getMessage()],500 );
        } 
        
        //die("End");

    }


    /**
     * Ingreso de inventario (Entrada) Suma inventario 
     */
    public static function Ingreso_inventario($p_in_product_id, $p_in_quantity){
        
        DB::beginTransaction();
          
        try{
            $cantidad_actual;
            $product_quantity = DB::table('products')->where('id',$p_in_product_id )->pluck('quantity');

            foreach ($product_quantity as $key => $object) {
                $cantidad_actual  = $object;
            }
        
        
            $inventario = DB::table('products')
            ->where('id', $p_in_product_id )
            ->update(['quantity' => ($cantidad_actual + $p_in_quantity) ,
                    'updated_at' => now() ]);
                    $inventario =  DB::commit();
           // return 1 ;
        } catch (\Exception $ex) {
                 // $queries = DB::getQueryLog();
                 // echo $ex->getMessage();
                 DB::rollback();
                 return response()->json(['data' =>$ex->getMessage()],500 );
        } 
        
        //die("End");

    }



    public static function RegistarComisionColaborador($id_cab_pedido, $total_comission,$order_status_cod,$fechaIngresoPedido, $collaborator_id, $operacion, $mensaje_orden){
    
        
        /**
         * Definir la fecha inicio y fin de un mes
         * basado en fecha que ingresa a la orden
         */
        $fecha=$fechaIngresoPedido;

        $anio = date("Y", strtotime($fecha)); 
        $mes = date("m", strtotime($fecha)); 

        //fecha fin de mes
        $month     = $anio.'-'.$mes  ;
        $aux         = date('Y-m-d', strtotime("{$month} + 1 month"));
        $last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));

        //fecha inicio de mes
        $aux1         = date('Y-m-d', strtotime("{$month} + 1 month"));
        $start_day = date('Y-m-01', strtotime("{$aux1} -  1 day"));

        $p_in_month_start_date = $start_day; //$inicio = date("Y-m-01");
        $p_in_month_end_date = $last_day; //$fin = date("Y-m-t");
        $p_in_month = $mes;//$mes = date("m");
        $p_in_year = $anio;// $anio = date("Y");
        $p_in_total_comission = $total_comission;
        $p_in_status = $order_status_cod;
        $p_in_collaborator_id = $collaborator_id;
        $fecha_orden = $fechaIngresoPedido;

        $count_colaborador="";
        $id_comis= ""; 
        $num_ordenes="";
        $total_comision_actual="";
        $id_colab = "";

        DB::beginTransaction();

        try {

            $verificar_fecha_colaborador = DB::select('select id,total_comission,collaborator_id,quantity_orders,count(*) as rft from comissions where collaborator_id = '.$p_in_collaborator_id.' and '."'$fecha_orden'".' BETWEEN month_start_date AND month_end_date GROUP BY id,total_comission,collaborator_id,quantity_orders');

            foreach ($verificar_fecha_colaborador as $key => $object) {
                $id_comis= $object->id;
                $total_comision_actual  = $object->total_comission;
                $id_colab  = $object->collaborator_id;
                $num_ordenes  = $object->quantity_orders;
                $count_colaborador  = $object->rft ;
            }

            if(empty($count_colaborador)){//si es vacio
                DB::insert('insert comissions (
                    total_comission,
                    month_start_date,
                    month_end_date,
                    quantity_orders,
                    month,
                    year,
                    status,
                    collaborator_id,
                    created_at,
                    updated_at
                ) values (?,?,?,?,?,?,?,?,?,?)', [
                    $p_in_total_comission,
                    $p_in_month_start_date,
                    $p_in_month_end_date ,
                    1,
                    $p_in_month,
                    $p_in_year,
                    $p_in_status,   
                    $p_in_collaborator_id,
                    now(),  
                    now()
                ]);   
                DB::commit();

                self::Cambiar_Estado_Orden($id_cab_pedido, $order_status_cod);
                self::Registar_Transaciones_Ordenes($id_cab_pedido, $p_in_collaborator_id, $order_status_cod);
                $out_id_order = $id_cab_pedido;
                $out_cod = 7; 
                $out_msj = 'Pedido '.$id_cab_pedido.'. Guardado como '.$mensaje_orden;
            
                $msj = self::msj_estado_orden($out_id_order, $out_cod, $out_msj);

                return $msj;
            }else{
                
                switch ($operacion){
                    case "SU":
                   
                        $totalComision = ($total_comision_actual + $p_in_total_comission);
                        $cantidadOrdenes = ($num_ordenes + 1);
                        $respuesta = self::ActualizarComision($id_comis,$id_colab,$totalComision,$cantidadOrdenes , $id_cab_pedido, $p_in_status, "Entregado");
                        
                        return $respuesta;
                    
                    break;

                    case "RE":

                        $comision_mayor = max($total_comision_actual ,$p_in_total_comission); 
                        $comision_menor = min($total_comision_actual ,$p_in_total_comission); 
                       
                        $totalComision = ($comision_mayor - $comision_menor);//($total_comision_actual - $p_in_total_comission);
                        $cantidadOrdenes = ($num_ordenes - 1);
                        $respuesta = self::ActualizarComision($id_comis,$id_colab,$totalComision,$cantidadOrdenes , $id_cab_pedido, $p_in_status, $mensaje_orden);
                        
                        self::Borrar_Comsion_Cerro($p_in_collaborator_id, $fecha_orden);
                        
                        return $respuesta;
                    break;
                }
                
            }
             
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
            return response()->json(['data' =>$e->getMessage()],500 );
        }
    }


    public static function msj_estado_orden($out_id_order, $out_cod, $out_msj){
        $miArray = array('out_id_order'=>$out_id_order, 'out_cod'=>$out_cod, 'out_msj'=>$out_msj);
        return response()->json(['data' => $miArray], 200);
        
    }

    public static function ActualizarComision($id_comis,$id_colab,$totalComision,$cantidadOrdenes , $id_cab_pedido, $p_in_status, $mensaje_orden){
        
        DB::table('comissions')
            ->where('id', $id_comis  )
            ->where('collaborator_id', $id_colab  )
            ->update(['total_comission' => $totalComision,//($total_comision_actual + $p_in_total_comission) ,
                    'quantity_orders' => $cantidadOrdenes,//($num_ordenes + 1),
                    'updated_at' => now() ]);
                 
        DB::commit();
            self::Cambiar_Estado_Orden($id_cab_pedido, $p_in_status);
            $out_id_order = $id_cab_pedido;
            $out_cod = 7; 
            $out_msj = 'Pedido '.$id_cab_pedido.'. Guardado como '.$mensaje_orden;
        
            $msj = self::msj_estado_orden($out_id_order, $out_cod, $out_msj );

        return $msj;
      
    }
  


    /**
     * Funcion para cambiar el estado de orden
    */
    public static function Cambiar_Estado_Orden($id_cab_pedido, $order_status_cod){
        
        DB::beginTransaction();
          
        try{
            // $cantidad_actual;
            // $product_quantity = DB::table('products')->where('id',$p_in_product_id )->pluck('quantity');

            // foreach ($product_quantity as $key => $object) {
            //     $cantidad_actual  = $object;
            // }
        
        
            $OrdenEstado = DB::table('orders')
            ->where('id', $id_cab_pedido )
            ->update(['order_status_cod' => $order_status_cod ,
                    'updated_at' => now() ]);
                    
            $OrdenEstado  =  DB::commit();
           // return 1 ;
        } catch (\Exception $ex) {
                 // $queries = DB::getQueryLog();
                 // echo $ex->getMessage();
                 DB::rollback();
                 return response()->json(['data' =>$ex->getMessage()],500 );
        } 
        //die("End");
    }


    /**
     * 
     */
    public static function Verificar_Estado_Orden($id_cab_pedido, $order_status_cod){
      
        try{
           
            $ordenEstado = Order::
            where('orders.id', $id_cab_pedido )
            ->where('orders.order_status_cod','=', $order_status_cod)
            ->count();

            return $ordenEstado;
          
        } catch (\Exception $ex) {
            return response()->json(['data' =>$ex->getMessage()],500 );
        } 
        //die("End");
    }

    
    public static function ConsultarEstadoOrden($id_cab_pedido){
      
        try{
           
            $ordenEstado = Order::
            where('orders.id', $id_cab_pedido )
            ->pluck('order_status_cod')->first();

            return $ordenEstado;
          
        } catch (\Exception $ex) {
            return response()->json(['data' =>$ex->getMessage()],500 );
        } 
        //die("End");
    }


    /**
    *registrar la transaccion de cambio de estado 
    */
    public static function Registar_Transaciones_Ordenes($id_cab_pedido, $in_collaborator_id, $in_order_status_cod){
        
        DB::beginTransaction();
          
        try{
            
            DB::insert('insert into order_transaction (
                order_id, user_id, status_order, created_at, updated_at
                ) values (?, ?, ?, ?,? )', [ $id_cab_pedido, $in_collaborator_id, $in_order_status_cod,now(),now()]);
                 
            DB::commit();
          
        } catch (\Exception $ex) {
                 // $queries = DB::getQueryLog();
                 // echo $ex->getMessage();
            DB::rollback();
            return response()->json(['data' =>$ex->getMessage()],500 );
        } 
        //die("End");
    }
   
    /**
     * Ayuda a verificar si la comision existe o no
     */
    public static function Verificar_Comision($p_in_collaborator_id, $fecha_orden){
        
        $count_colaborador = "";
        try{
           
            $verificar_ = DB::select('select count(*) as rft from comissions where collaborator_id = '.$p_in_collaborator_id.' and '."'$fecha_orden'".' BETWEEN month_start_date AND month_end_date GROUP BY id,total_comission,collaborator_id,quantity_orders');

            foreach ($verificar_ as $key => $object) {
                // $id_comis= $object->id;
                // $total_comision_actual  = $object->total_comission;
                // $id_colab  = $object->collaborator_id;
                // $num_ordenes  = $object->quantity_orders;
                $count_colaborador  = $object->rft ;
            }

            return $count_colaborador;
          
        } catch (\Exception $ex) {
            return response()->json(['data' =>$ex->getMessage()],500 );
        } 
        //die("End");
    }

    /**
     * Borrar la comision cuando  quede en CERO cuando se resten 
     */
    public static function Borrar_Comsion_Cerro($p_in_collaborator_id, $fecha_orden){
         
        $count_colaborador="";
        $id_comis= ""; 
        $num_ordenes="";
        $total_comision_actual="";
        $id_colab = "";
        
        $verificar_fecha_colaborador = DB::select('select id,total_comission,collaborator_id,quantity_orders,count(*) as rft from comissions where collaborator_id = '.$p_in_collaborator_id.' and '."'$fecha_orden'".' BETWEEN month_start_date AND month_end_date GROUP BY id,total_comission,collaborator_id,quantity_orders');

        foreach ($verificar_fecha_colaborador as $key => $object) {
            $id_comis= $object->id;
            $total_comision_actual  = $object->total_comission;
            $id_colab  = $object->collaborator_id;
            $num_ordenes  = $object->quantity_orders;
            $count_colaborador  = $object->rft ;
        }
        if($total_comision_actual == 0){
            DB::table('comissions')->where('id', '=', $id_comis)->delete();
        }
        
    }
    
    
}