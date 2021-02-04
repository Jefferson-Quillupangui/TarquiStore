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
       $sectors = Sector::orderBy('codigo', 'asc')->pluck('name','codigo');
       
      // $category = Category::orderBy('id', 'asc')->pluck('name','id');

        return view('pedido.create', compact('name','sectors'));//compact('category','name','sectors'));
    }

    

    
    public function listaClientes_json(){

        // $data = DB::select('call sp_con_buscar_cliente(?,?)', array('AA',''));
        // return response()->json(['data' => $data], 200);
   
        

        // $cliente = Client::  where('status',  'A')
        // ->get(['id', 
        // 'identification', 'name','last_name',  'address', 
        // 'phone1','phone2', 'email','status',  'type_identification_cod']);

        
        
        
        // $cliente = Client:: where('status',  'A')
        // ->with([
        //     'typeIdentification' => function($query) {
        //         $query->select('codigo', 'name');//->where('status',  'A'); # Muchos a muchos
        //     }
        // ])
        //     ->get(
        //         ['id', 
        //     'identification', 'name','last_name',  'address', 
        //     'phone1','phone2', 'email','status',  'type_identification_cod']
        // );

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

    public function createOrden(Request $request){

        //return 'Hola';
        $p_in_opcio =  $request->opcion;//text, 
        $in_delivery_date = '2021-01-24 17:44:52'; //datetime,
		$in_delivery_address = $request->addresdelivery; // mediumtext,
		$in_total_order = $request->totalord; //decimal(8,2),
		$in_total_comission=3.99; //decimal(8,2),
		$in_observation='LLamar al cliente'; //mediumtext,
		$in_sector_id =1;//int,
        $in_city_sale_id =1;//int,
        $in_client_id= $request->clienteid; //int,
        $in_collaborator_id = 1;//int,
        $in_order_status = 1;//int,
        
        $data = DB::select('call sp_trx_crear_orden(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
            array($p_in_opcio,
                    $in_delivery_date,
                    $in_delivery_address,
                    $in_total_order,
                    $in_total_comission,
                    $in_observation,
                    $in_sector_id,
                    $in_city_sale_id,
                    $in_client_id,
                    $in_collaborator_id,
                    $in_order_status,
                    "@val",
                    "@val",
                    "@val"));
        return response()->json(['data' => $data], 200);
    } 
}