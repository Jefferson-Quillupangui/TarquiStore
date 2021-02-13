<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\User;
use App\Models\Sector;
use App\Models\Client;
use App\Models\CitySale;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\OrderProduct;
use App\Models\Pivot;

//use App\Class\C_Order;

use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

use App\Classes\PedidosClass;

class PedidosController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name; 
       // $order = Order::all();
       //$categories = Category::all();
       //$sectors = Sector::orderBy('codigo', 'asc')->pluck('name','codigo');
       $sectors = Sector::where('status', '=', 'A')->get();
       $citySale = CitySale::where('status', '=', 'A')->get();
       $orderStatus = OrderStatus::all();
      // $category = Category::orderBy('id', 'asc')->pluck('name','id');

        return view('pedido.create', compact('name','sectors','citySale', 'orderStatus'));//compact('category','name','sectors'));
    }

    
  
    
    
    public function listaClientes_json(){

        $cliente = Client::join("type_identifications AS b","clients.type_identification_cod","=","b.codigo")
        ->select('clients.id', 'clients.identification', 'clients.name', 
                'clients.last_name', 'clients.address', 'clients.phone1', 'clients.phone2',
                 'clients.email', 'clients.status', 'clients.type_identification_cod',
                 'b.codigo', 'b.name AS name_document'
                 )
        ->where('clients.status','=','A')
        ->get();
   

        return response()->json(['data' => $cliente], 200);
    
    }


    public function listaProductos_json(){

        
        $product = Product::join("categories AS b","products.category_id","=","b.id")
        ->select('products.id', 
                    'products.name',
                    'products.image',
                    'products.price' ,
                    'products.description',
                    'products.comission' ,
                    'products.quantity' , 
                    'products.discount' ,
                    'products.price_discount',
                    'products.status',
                    'products.category_id' ,
                    'b.name AS name_categories'
                 )
        ->where('products.status','=','A' )
        ->where('products.quantity','>',0  )
        ->get();
   
         return response()->json(['data' => $product], 200);
    
    }

    public function listaOrders_json(){
        
       
        
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
        //->where('orders.order_status_cod','=','OP' )
        ->where('orders.order_status_cod','=','OR')
        ->orWhere('orders.order_status_cod','=','OP')
        //->where('orders.order_status_cod',['OR'] )
        //->where('products.quantity','>',0  )
        ->get();
        return response()->json(['data' => $orders], 200);
    }

    
    public function stock_product_json(Request $request){
        
        $v_id_producto = $request->id_producto;
        
        $stock_product = Product::
            select(
                'quantity'
            )
        ->where('products.id','=',$v_id_producto)
        ->get();
        return response()->json(['data' => $stock_product], 200);
    }

    public function detalleOrders_json(Request $request ){
        $v_id_orden = $request->id_orden;
      //Eloquent ORM
        //$detalle_orders = OrderProduct:://join("orders AS a","order_product.order","=","a.id")
        //->join("products AS b","order_product.product_id","=","b.id")

        
        
         //Database: Query Builder
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

      public function createOrden(Request $request){

        $c_pedidos = new PedidosClass();
        $opcion = $request->opcion;
        $id_cab_pedido = $request->id_pedido;//pk auto

        $in_client_id	= $request->client_id;//bigint//
        $in_delivery_date= $request->delivery_date;	//date
        $in_delivery_time= $request->delivery_time;	//time
        $in_collaborator_id	= $request->collaborator_id; //bigint
        $in_sector_cod= $request->sector_cod;	//varchar
        $in_city_sale_cod	= $request->city_sale_cod;//varchar
        $in_observation	= $request->observation;//mediumtext
        $in_delivery_address= $request->delivery_address;	//mediumtext
        $in_status_comission= 'f';	//varchar
        $in_order_status_cod = $request->order_status_cod;//'OP';	//varchar
        $in_total_order= $request->total_order;	//decimal
        $in_total_comission= $request->total_comission;	//decimal


        $p_in_tabla_detalle = $request->detalleProductos;
        $json_tb_detalle_prodct = json_decode($p_in_tabla_detalle, true);
       
        $dat_cab = $request;

         DB::beginTransaction();
         
         if( $opcion == 'AA' ){
             //Metodo de Guardar
            

             try {
                 $insertado = DB::insert('insert orders (delivery_date , delivery_time, delivery_address,
                                                             total_order, total_comission ,  observation,
                                                             status_comission, sector_cod,  city_sale_cod,
                                                             client_id, collaborator_id, order_status_cod,
                                                             created_at, updated_at
                 ) values (?,?,?,?,?,    ?,?,?,?,?,  ?,?,?,?)', [
                                                             $in_delivery_date,  $in_delivery_time, $in_delivery_address,
                                                             $in_total_order, $in_total_comission,
                                                             $in_observation,$in_status_comission,$in_sector_cod,
                                                             $in_city_sale_cod,$in_client_id,$in_collaborator_id,
                                                             $in_order_status_cod,now(),now()]);
     
                                                             $id_cab ;
     
                                                            
                                                             // $rpt_id;
                                                             // //echo "------- Sólo valores -------\n\n";
                                                             // foreach ($jsonObject->rates as $v){
                                                             //     $rpt_id =  $v;
                                                             // }
                                                             
                                                             
                                                             $out_id_od = DB::selectOne('SELECT LAST_INSERT_ID() as id');
                                                             foreach ($out_id_od as $key => $object) {
                                                                 $id_cab  = $object;
                                                             }

                                                             $out_id_order = $id_cab;
                                                             $out_cod = 7;
                                                             $out_msj = "Orden creada";
                                                        /**
                                                        * procesar detalle
                                                        */
                                                        //$id_cab = (int)$out_id_order;
                                                        // dd($out_id_order);
                                                        if ( $out_cod == 7) {
                                                            DB::commit();
                                                            foreach ($json_tb_detalle_prodct as $value) {
                                                                //dd($value);
                                                                //$p_in_order_id =  $value['product_id'];//fk cabecera
                                                                $p_in_product_id =  $value['product_id'];
                                                                $p_in_name_product =  $value['name_product'];
                                                                $p_in_quantity  =  $value['quantity'];
                                                                $p_in_price =  $value['price'];
                                                                $p_in_discount_porcentage =  $value['discount_porcentage'];
                                                                $p_in_price_discount  =  $value['price_discount'];
                                                                $p_in_total_line =  $value['total_line'];
                                                                $p_in_comission  =  $value['comission'];
                                                                $p_in_total_comission = $value['total_comission'];


                                                                $insertadoDetalle = DB::insert('insert order_product (
                                                                    order_id,
                                                                product_id,
                                                                name_product,
                                                                quantity,
                                                                price,
                                                                discount_porcentage,
                                                                price_discount,
                                                                total_line,
                                                                comission,
                                                                total_comission,
                                                                created_at,
                                                                updated_at
                                                                    ) values (?,?,?,?,?,    ?,?,?,?,?,  ?,?)', [
                                                                        $id_cab ,// $out_id_order,
                                                                       $p_in_product_id ,
                                                                        $p_in_name_product,
                                                                        $p_in_quantity ,
                                                                        $p_in_price ,
                                                                        $p_in_discount_porcentage ,
                                                                        $p_in_price_discount ,
                                                                        $p_in_total_line,
                                                                        $p_in_comission,
                                                                        $p_in_total_comission,
                                                                now(),now()]);
                                                                
                                                                
                                                               
                                                                $c_pedidos->Egreso_inventario($p_in_product_id , $p_in_quantity );
                                                            
                                                                
                                                                
                                                                
                                                            }

                                                            DB::insert('insert into order_transaction (
                                                            order_id, user_id, status_order, created_at, updated_at
                                                            ) values (?, ?, ?, ?,? )', [ $id_cab, $in_collaborator_id, $in_order_status_cod,now(),now()]);
                                                            
                                                        }else{
                                                            DB::rollback();
                                                        }
     
                                                       
                 
                                                             /**
                                                              * respuesta de cabecera 
                                                              */
                                                         $miArray = array('out_id_order'=>$out_id_order, 'out_cod'=>$out_cod, 'out_msj'=>$out_msj);
                                                         return response()->json(['data' => $miArray], 200);
                                                            
                                            
                 
             } catch (\Exception $ex) {
                 // $queries = DB::getQueryLog();
                 // echo $ex->getMessage();
                 DB::rollback();
                 return response()->json(['data' =>$ex->getMessage()],500 );
             }die("End");
             
         }elseif ($opcion == 'AB') {
            //Metodo de Actualizar
            try {

                $actulizar = DB::table('orders')
              ->where('id', $id_cab_pedido)
              ->update(['delivery_date' => $in_delivery_date ,
                        'delivery_time' => $in_delivery_time ,
                        'delivery_address' => $in_delivery_address ,
                        'total_order' => $in_total_order ,
                        'total_comission' => $in_total_comission ,
                        'observation' => $in_observation ,
                        'status_comission' => $in_status_comission ,
                        'sector_cod' => $in_sector_cod ,
                        'city_sale_cod' => $in_city_sale_cod ,
                        'collaborator_id' => $in_collaborator_id ,
                        'order_status_cod' => $in_order_status_cod ,
                        'updated_at' => now() ]);
              
               
                                                            
                        $out_id_order = $id_cab_pedido;
                        $out_cod = 7;
                        $out_msj = "Orden Actualizada";
    
                        // foreach ($out_id_order as $key => $object) {
                        //     $id_cab  = $object;
                        // }
    
                        //DB::commit();
                        if ( $out_cod == 7) {
                            DB::commit();
                                foreach ($json_tb_detalle_prodct as $value) {
                                    //dd($value);
                                    //$p_in_order_id =  $value['product_id'];//fk cabecera
                                    $p_in_id_detalle_product =  $value['id_detalle_product'];
                                    $p_in_product_id =  $value['product_id'];
                                    $p_in_name_product =  $value['name_product'];
                                    $p_in_quantity  =  $value['quantity'];
                                    $p_in_price =  $value['price'];
                                    $p_in_discount_porcentage =  $value['discount_porcentage'];
                                    $p_in_price_discount  =  $value['price_discount'];
                                    $p_in_total_line =  $value['total_line'];
                                    $p_in_comission  =  $value['comission'];
                                    $p_in_total_comission = $value['total_comission'];


                                    if($p_in_id_detalle_product > 0){

                                        
                                        $bd_quantity_prod_det;
                                        $bd_cantidad_prod_det = DB::table('order_product')->where('product_id',$p_in_product_id )->pluck('quantity');

                                        foreach ($bd_cantidad_prod_det as $key => $object) {
                                            $bd_quantity_prod_det  = $object;
                                        }

                                        if( $bd_quantity_prod_det != $p_in_quantity ){

                                            $cantidad_mayor = max($bd_quantity_prod_det, $p_in_quantity); 
                                            $cantidad_menor = min($bd_quantity_prod_det, $p_in_quantity); 
                                            $p_quantity_result = $cantidad_mayor - $cantidad_menor;
                                            
                                            if( $p_in_quantity > $bd_quantity_prod_det ){
                                                //Egreso de inventario
                                                $c_pedidos->Egreso_inventario($p_in_product_id , $p_quantity_result );
                                            }else if( $p_in_quantity < $bd_quantity_prod_det){
                                                //Ingreso de inventario
                                                 $c_pedidos->Ingreso_inventario($p_in_product_id , $p_quantity_result );
                                            }
                                            
                                          

                                            
                                        }

                                        // $bd_quantity_prod_det_actual;
                                        // $bd_cantidad_prod_det_op = DB::table('order_product')->where('product_id',$p_in_product_id )->pluck('quantity');

                                        // foreach ($bd_cantidad_prod_det_op as $key => $object) {
                                        //     $bd_quantity_prod_det_actual  = $object;
                                        // }
                                        
                                        $detalle_pedido_actualizar = DB::table('order_product')
                                        ->where('id_detalle_product' , $p_in_id_detalle_product)
                                        ->update(
                                            ['order_id' => $id_cab_pedido, 
                                                'product_id' =>  $p_in_product_id,
                                                'name_product' =>  $p_in_name_product ,
                                                'quantity' => $p_in_quantity,//$bd_quantity_prod_det_actual,//$p_in_quantity ,
                                                'price' => $p_in_price,
                                                'discount_porcentage' =>  $p_in_discount_porcentage,
                                                'price_discount' =>  $p_in_price_discount,
                                                'total_line' => $p_in_total_line,
                                                'comission' => $p_in_comission,
                                                'total_comission' => $p_in_total_comission,
                                                'updated_at' => now()]);

                                         
                                    }else{
                                        $insertadoDetalle = DB::insert('insert order_product (
                                            order_id,
                                        product_id,
                                        name_product,
                                        quantity,
                                        price,
                                        discount_porcentage,
                                        price_discount,
                                        total_line,
                                        comission,
                                        total_comission,
                                        created_at,
                                        updated_at
                                            ) values (?,?,?,?,?,    ?,?,?,?,?,  ?,?)', [
                                                $id_cab_pedido ,// $out_id_order,
                                               $p_in_product_id ,
                                                $p_in_name_product,
                                                $p_in_quantity ,
                                                $p_in_price ,
                                                $p_in_discount_porcentage ,
                                                $p_in_price_discount ,
                                                $p_in_total_line,
                                                $p_in_comission,
                                                $p_in_total_comission,
                                        now(),now()]);

                                        $c_pedidos = new PedidosClass();
                                        $c_pedidos->Egreso_inventario($p_in_product_id , $p_in_quantity );
                                    }
                                    
                                    
                                }


                                                              
                                
                                
                                DB::insert('insert into order_transaction (
                                order_id, user_id, status_order, created_at, updated_at
                                ) values (?, ?, ?, ?,? )', [ $id_cab_pedido, $in_collaborator_id, $in_order_status_cod,now(),now()]);
                                                            
                        }else{
                            DB::rollback();
                        }
                
                        /**
                         * respuesta de cabecera 
                         */
                        $miArray = array('out_id_order'=>$out_id_order, 'out_cod'=>$out_cod, 'out_msj'=>$out_msj);
                        return response()->json(['data' => $miArray], 200);
                                                           
                                                            
                
            } catch (\Exception $ex) {
                // $queries = DB::getQueryLog();
                // echo $ex->getMessage();
                DB::rollback();
                return response()->json(['data' =>$ex->getMessage()],500 );
            }die("End");
            
            
        } else {
            // No existe Opcion para el metodo
            return response()->json(['data' =>'Opcion no definida'],500 );
        }
        
        //
       
    
    } 

    
   
    // public function createOrden(Request $request){

      
    //     $in_client_id	= $request->client_id;//bigint//
    //     $in_delivery_date= $request->delivery_date;	//date
    //     $in_delivery_time= $request->delivery_time;	//time
    //     $in_collaborator_id	= $request->collaborator_id; //bigint
    //     $in_sector_cod= $request->sector_cod;	//varchar
    //     $in_city_sale_cod	= $request->city_sale_cod;//varchar
    //     $in_observation	= $request->observation;//mediumtext
    //     $in_delivery_address= $request->delivery_address;	//mediumtext
    //     $in_status_comission= 'f';	//varchar
    //     $in_order_status_cod ='OP';	//varchar
    //     $in_total_order= $request->total_order;	//decimal
    //     $in_total_comission= $request->total_comission;	//decimal


    //     $p_in_tabla_detalle = $request->detalleProductos;
    //     $json_tb_detalle_prodct = json_decode($p_in_tabla_detalle, true);
        


    //     //

    //     try {
    //         $insertado = DB::insert('insert orders (delivery_date , delivery_time, delivery_address,
    //                                                     total_order, total_comission ,  observation,
    //                                                     status_comission, sector_cod,  city_sale_cod,
    //                                                     client_id, collaborator_id, order_status_cod,
    //                                                     created_at, updated_at
    //         ) values (?,?,?,?,?,    ?,?,?,?,?,  ?,?,?,?)', [
    //                                                     $in_delivery_date,  $in_delivery_time, $in_delivery_address,
    //                                                     $in_total_order, $in_total_comission,
    //                                                     $in_observation,$in_status_comission,$in_sector_cod,
    //                                                     $in_city_sale_cod,$in_client_id,$in_collaborator_id,
    //                                                     $in_order_status_cod,now(),now()]);

    //                                                     $id_cab ;

                                                       
    //                                                     // $rpt_id;
    //                                                     // //echo "------- Sólo valores -------\n\n";
    //                                                     // foreach ($jsonObject->rates as $v){
    //                                                     //     $rpt_id =  $v;
    //                                                     // }
                                                        
    //                                                     $out_id_order = DB::selectOne('SELECT LAST_INSERT_ID() as id');
    //                                                     $out_cod = 7;
    //                                                     $out_msj = "Orden creada";

    //                                                     foreach ($out_id_order as $key => $object) {
    //                                                         $id_cab  = $object;
    //                                                     }

    //                                                     /**
    //                                                      * procesar detalle
    //                                                      */
    //                                                     //$id_cab = (int)$out_id_order;
    //                                                     // dd($out_id_order);
    //                                                     if ( $out_cod == 7) {

    //                                                         foreach ($json_tb_detalle_prodct as $value) {
    //                                                             //dd($value);
    //                                                             //$p_in_order_id =  $value['product_id'];//fk cabecera
    //                                                             $p_in_product_id =  $value['product_id'];
    //                                                             $p_in_name_product =  $value['name_product'];
    //                                                             $p_in_quantity  =  $value['quantity'];
    //                                                             $p_in_price =  $value['price'];
    //                                                             $p_in_discount_porcentage =  $value['discount_porcentage'];
    //                                                             $p_in_price_discount  =  $value['price_discount'];
    //                                                             $p_in_total_line =  $value['total_line'];
    //                                                             $p_in_comission  =  $value['comission'];
    //                                                             $p_in_total_comission = $value['total_comission'];


    //                                                             $insertadoDetalle = DB::insert('insert order_product (
    //                                                                 order_id,
    //                                                             product_id,
    //                                                             name_product,
    //                                                             quantity,
    //                                                             price,
    //                                                             discount_porcentage,
    //                                                             price_discount,
    //                                                             total_line,
    //                                                             comission,
    //                                                             total_comission,
    //                                                             created_at,
    //                                                             updated_at
    //                                                                 ) values (?,?,?,?,?,    ?,?,?,?,?,  ?,?)', [
    //                                                                     $id_cab ,// $out_id_order,
    //                                                                    $p_in_product_id ,
    //                                                                     $p_in_name_product,
    //                                                                     $p_in_quantity ,
    //                                                                     $p_in_price ,
    //                                                                     $p_in_discount_porcentage ,
    //                                                                     $p_in_price_discount ,
    //                                                                     $p_in_total_line,
    //                                                                     $p_in_comission,
    //                                                                     $p_in_total_comission,
    //                                                             now(),now()]);
                                                                
    //                                                             //echo '<pre>'; print_r($insertadoDetalle);
                                                                
    //                                                         }
    //                                                     }
            
    //                                                     /**
    //                                                      * respuesta de cabecera 
    //                                                      */
    //                                                     $miArray = array('out_id_order'=>$out_id_order, 'out_cod'=>$out_cod, 'out_msj'=>$out_msj);
    //                                                     return response()->json(['data' => $miArray], 200);
                                                       

				
                                                        
    //         // if($insertado){
    //         // $id = DB::selectOne('SELECT LAST_INSERT_ID() as "id"');
    //         // DB::rollback();
    //         //     //DB::commit();
    //         //     return 'Insertado correctamente con id ' . $id->id;
    //         // }
            
    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         throw $e;
    //     }
    
    // } 

    

    // public function createOrden(Request $request){

    //     //return 'Hola';
    //     $p_in_opcio =  $request->opcion;//text, 
    //     $in_delivery_date = '2021-01-24 17:44:52'; //datetime,
	// 	$in_delivery_address = $request->addresdelivery; // mediumtext,
	// 	$in_total_order = $request->totalord; //decimal(8,2),
	// 	$in_total_comission=3.99; //decimal(8,2),
	// 	$in_observation='LLamar al cliente'; //mediumtext,
	// 	$in_sector_id =1;//int,
    //     $in_city_sale_id =1;//int,
    //     $in_client_id= $request->clienteid; //int,
    //     $in_collaborator_id = 1;//int,
    //     $in_order_status = 1;//int,
        
    //     $data = DB::select('call sp_trx_crear_orden(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
    //         array($p_in_opcio,
    //                 $in_delivery_date,
    //                 $in_delivery_address,
    //                 $in_total_order,
    //                 $in_total_comission,
    //                 $in_observation,
    //                 $in_sector_id,
    //                 $in_city_sale_id,
    //                 $in_client_id,
    //                 $in_collaborator_id,
    //                 $in_order_status,
    //                 "@val",
    //                 "@val",
    //                 "@val"));
    //     return response()->json(['data' => $data], 200);
    // } 




    // public function listaClientes_json(){

    //     // $data = DB::select('call sp_con_buscar_cliente(?,?)', array('AA',''));
    //     // return response()->json(['data' => $data], 200);
   
        

    //     // $cliente = Client::  where('status',  'A')
    //     // ->get(['id', 
    //     // 'identification', 'name','last_name',  'address', 
    //     // 'phone1','phone2', 'email','status',  'type_identification_cod']);

        
        
        
    //     // $cliente = Client:: where('status',  'A')
    //     // ->with([
    //     //     'typeIdentification' => function($query) {
    //     //         $query->select('codigo', 'name');//->where('status',  'A'); # Muchos a muchos
    //     //     }
    //     // ])
    //     //     ->get(
    //     //         ['id', 
    //     //     'identification', 'name','last_name',  'address', 
    //     //     'phone1','phone2', 'email','status',  'type_identification_cod']
    //     // );

    //     $cliente = Client::join("type_identifications AS b","clients.type_identification_cod","=","b.codigo")
    //     ->select('clients.id', 'clients.identification', 'clients.name', 
    //             'clients.last_name', 'clients.address', 'clients.phone1', 'clients.phone2',
    //              'clients.email', 'clients.status', 'clients.type_identification_cod',
    //              'b.codigo', 'b.name AS name_document'
    //              )
    //     ->where('clients.status','=','A')
    //     ->get();
   

    //     return response()->json(['data' => $cliente], 200);
    
    // }

    //**************************************************************************************** */
    // public function createOrden(Request $request){

      
    //     $in_client_id	= $request->client_id;//bigint//
    //     $in_delivery_date= $request->delivery_date;	//date
    //     $in_delivery_time= $request->delivery_time;	//time
    //     $in_collaborator_id	= $request->collaborator_id; //bigint
    //     $in_sector_cod= $request->sector_cod;	//varchar
    //     $in_city_sale_cod	= $request->city_sale_cod;//varchar
    //     $in_observation	= $request->observation;//mediumtext
    //     $in_delivery_address= $request->delivery_address;	//mediumtext
    //     $in_status_comission= 'f';	//varchar
    //     $in_order_status_cod ='A';	//varchar
    //     $in_total_order= $request->total_order;	//decimal
    //     $in_total_comission= $request->total_comission;	//decimal
        


    //     //

    //     try {
    //         $insertado = DB::insert('insert orders (delivery_date , delivery_time, delivery_address,
    //                                                     total_order, total_comission ,  observation,
    //                                                     status_comission, sector_cod,  city_sale_cod,
    //                                                     client_id, collaborator_id, order_status_cod,
    //                                                     created_at, updated_at
    //         ) values (?,?,?,?,?,    ?,?,?,?,?,  ?,?,?,?)', [
    //                                                     $in_delivery_date, 
    //                                                     $in_delivery_time,
    //                                                     $in_delivery_address,
    //                                                     $in_total_order, $in_total_comission,
    //                                                     $in_observation,$in_status_comission,$in_sector_cod,
    //                                                     $in_city_sale_cod,$in_client_id,$in_collaborator_id,
    //                                                     $in_order_status_cod,now(),now()]);

                                                       
                                                        
    //                                                     // $rpt_id;
    //                                                     // //echo "------- Sólo valores -------\n\n";
    //                                                     // foreach ($jsonObject->rates as $v){
    //                                                     //     $rpt_id =  $v;
    //                                                     // }
                                                        
    //                                                     $out_id_order = DB::selectOne('SELECT LAST_INSERT_ID() as id');
    //                                                     $out_cod = 7;
    //                                                     $out_msj = "Orden creada";
            
                                                        
    //                                                     $miArray = array('out_id_order'=>$out_id_order, 'out_cod'=>$out_cod, 'out_msj'=>$out_msj);
    //                                                     return response()->json(['data' => $miArray], 200);
                                                       

				
                                                        
    //         // if($insertado){
    //         // $id = DB::selectOne('SELECT LAST_INSERT_ID() as "id"');
    //         // DB::rollback();
    //         //     //DB::commit();
    //         //     return 'Insertado correctamente con id ' . $id->id;
    //         // }
            
    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         throw $e;
    //     }
    
    // } 


}