<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;

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
}