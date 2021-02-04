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


use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name; 
       // $order = Order::all();
       //$categories = Category::all();
       //$sectors = Sector::orderBy('codigo', 'asc')->pluck('name','codigo');
       $sectors = Sector::all();
       $citySale = CitySale::all();
       
      // $category = Category::orderBy('id', 'asc')->pluck('name','id');

        return view('pedido.create', compact('name','sectors','citySale'));//compact('category','name','sectors'));
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
        ->where('products.status','=','A')
        ->get();
   
         return response()->json(['data' => $product], 200);
    
    }


      public function createOrden(Request $request){

        //return 'Hola';
        // $p_in_opcio =  $request->opcion;//text, 
        // $in_delivery_date = '2021-01-24 17:44:52'; //datetime,
		// $in_delivery_address = $request->addresdelivery; // mediumtext,
		// $in_total_order = $request->totalord; //decimal(8,2),
		// $in_total_comission=3.99; //decimal(8,2),
		// $in_observation='LLamar al cliente'; //mediumtext,
		// $in_sector_id =1;//int,
        // $in_city_sale_id =1;//int,
        // $in_client_id = $request->clienteid; //int,
        // $in_collaborator_id = 1;//int,
        // $in_order_status = 1;//int,

       // $in_id = $request->	//bigint
        $in_client_id	= $request->client_id;//bigint//
        $in_delivery_date= $request->delivery_date;	//date
        $in_delivery_time= $request->delivery_time;	//time
        $in_collaborator_id	= $request->collaborator_id; //bigint
        $in_sector_cod= $request->sector_cod;	//varchar
        $in_city_sale_cod	= $request->city_sale_cod;//varchar
        $in_observation	= $request->observation;//mediumtext
        $in_delivery_address= $request->delivery_address;	//mediumtext
        $in_status_comission= 'f';	//varchar
        $in_order_status_cod ='A';	//varchar
        $in_total_order= $request->total_order;	//decimal
        $in_total_comission= $request->total_comission;	//decimal



        //

        try {
            $insertado = DB::insert('insert orders (
                                                        delivery_date ,
                                                        delivery_time,
                                                        delivery_address,
                                                        total_order,
                                                        total_comission , 
                                                        observation,
                                                        status_comission,
                                                        sector_cod,
                                                        city_sale_cod,
                                                        client_id,
                                                        collaborator_id,
                                                        order_status_cod,
                                                        created_at,
                                                        updated_at
            ) values (?,?,?,?,?,    ?,?,?,?,?,  ?,?,?,?)', [
                                                        $in_delivery_date, 
                                                        $in_delivery_time,
                                                        $in_delivery_address,
                                                        $in_total_order, $in_total_comission,
                                                        $in_observation,$in_status_comission,$in_sector_cod,
                                                        $in_city_sale_cod,$in_client_id,$in_collaborator_id,
                                                        $in_order_status_cod,now(),now()]);

                                                       
                                                        
                                                        // $rpt_id;
                                                        // //echo "------- Sólo valores -------\n\n";
                                                        // foreach ($jsonObject->rates as $v){
                                                        //     $rpt_id =  $v;
                                                        // }
                                                        
                                                        $out_id_order = DB::selectOne('SELECT LAST_INSERT_ID() as id');
                                                        $out_cod = 7;
                                                        $out_msj = "Orden creada";
            
                                                        
                                                        $miArray = array('out_id_order'=>$out_id_order, 'out_cod'=>$out_cod, 'out_msj'=>$out_msj);
                                                        return response()->json(['data' => $miArray], 200);
                                                       

				
                                                        
            // if($insertado){
            // $id = DB::selectOne('SELECT LAST_INSERT_ID() as "id"');
            // DB::rollback();
            //     //DB::commit();
            //     return 'Insertado correctamente con id ' . $id->id;
            // }
            
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        
        


        
        // $data = DB::select('call sp_trx_crear_orden(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
        //     array($p_in_opcio,
        //             $in_delivery_date,
        //             $in_delivery_address,
        //             $in_total_order,
        //             $in_total_comission,
        //             $in_observation,
        //             $in_sector_id,
        //             $in_city_sale_id,
        //             $in_client_id,
        //             $in_collaborator_id,
        //             $in_order_status,
        //             "@val",
        //             "@val",
        //             "@val"));
        //return response()->json(['data' => 'ok'], 200);
    } 

    

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

}