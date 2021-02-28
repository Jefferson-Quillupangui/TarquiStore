<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\TypeIdentification;
use Tavo\ValidadorEc;


class ClientController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $clients = Client::get();     
        return view('clientes.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_identification = TypeIdentification::orderBy('codigo', 'asc')->pluck('name','codigo');
        $client = new Client;

        return view('clientes.create', compact('client','type_identification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Validación de campos
        $request->validate([
            'identification'            => 'unique:clients,identification',
            'name'                      => 'required',
            'last_name'                 => 'required',
            'address'                   => 'required',
            'phone1'                    => 'required',
            'type_identification'       => 'required',
        ], 
        [
            'identification.unique'         => 'La identificación ya existe en el sistema',
            'name.required'                 => 'Ingrese el nombre del cliente',
            'last_name.required'            => 'Ingrese el apellido del cliente',
            'address.required'              => 'Ingrese la dirección del cliente',
            'phone1'                        => 'Ingrese un teléfono de contacto',
            'type_identification.required'  => 'Ingrese un tipo de identificación',
        ]);

        //Crear categoria
        $client = Client::create([
            'identification'    => $request->identification,
            'name'              => $request->name,
            'last_name'         => $request->last_name,
            'address'           => $request->address,
            'phone1'            => $request->phone1,
            'phone2'            => $request->phone2,
            'email'             => $request->email,
            'sex'               => $request->sex,
            'type_identification_cod' => $request->type_identification,
        ]);

        return redirect()->route('clients.index')
                    ->with('status','El cliente se registró correctamente');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
  
        return view('clientes.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $type_identification = TypeIdentification::orderBy('codigo', 'asc')->pluck('name','codigo');
        return view('clientes.edit', compact('client','type_identification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Client $client)
    {
        
        //Validación de datos
        $request->validate([
            'identification'            => 'unique:clients,identification,'.$client->id,
            'name'                      => 'required',
            'last_name'                 => 'required',
            'address'                   => 'required',
            'phone1'                    => 'required',
            'type_identification'       => 'required',
        ], 
        [
            'identification.unique'         => 'La identificación ya existe en el sistema',
            'name.required'                 => 'Ingrese el nombre del cliente',
            'last_name.required'            => 'Ingrese el apellido del cliente',
            'address.required'              => 'Ingrese la dirección del cliente',
            'phone1'                        => 'Ingrese un teléfono de contacto',
            'type_identification.required'  => 'Ingrese un tipo de identificación',
        ]);


        //Actualizar datos en la tabla
        $client->update([
            'identification'    => $request->identification,
            'name'              => $request->name,
            'last_name'         => $request->last_name,
            'address'           => $request->address,
            'phone1'            => $request->phone1,
            'phone2'            => $request->phone2,
            'email'             => $request->email,
            'sex'               => $request->sex,
            'type_identification_cod' => $request->type_identification,
        ]);

        return redirect()->route('clients.index',$client)
                ->with('status','El cliente se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('status','El cliente se eliminó correctamente.');
    }

    
    public function validarIdentificacion(Request $request){

        
        $identificacion = $request->identificacion ;
        $tipoDocumt = $request->tipoDocumt ;

     
    
        if( $tipoDocumt == "05"){
           $rpt = $this->cedula($identificacion);
           return $rpt;
        }else if($tipoDocumt == "06"){
            $rpt = $this->Ruc($identificacion);
            return $rpt;
        }
        
        
         
    }

    public function cedula($identificacion){

        $validador = new ValidadorEc();
        
        if ($validador->validarCedula($identificacion)) {
            //echo 'Cédula válida';
           // $out_id_order = $id_cab_pedido;
            $out_cod = 7; 
            $out_msj = 'Cédula válida.';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
            //return $msj = $this->msj_estado_orden($out_id_order, $out_cod, $out_msj);
        } else {
            //echo 'Cédula incorrecta: '.$validador->getError();
            $out_cod = 6; 
            $out_msj = 'Cédula incorrecta: '.$validador->getError();
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
            
        }
        
    }


    public function Ruc($identificacion){

        $validador = new ValidadorEc();
        
        // validar RUC persona natural
        if ($validador->validarRucPersonaNatural($identificacion)) {
            $out_cod = 7; 
            $out_msj = 'RUC válido Pesona Natural';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        } 
        // validar RUC sociedad privada
        else if ($validador->validarRucSociedadPrivada($identificacion)) {
            $out_cod = 7; 
            $out_msj = 'RUC válido Sociedad Privada';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        }
        // validar RUC sociedad pública
        else if ($validador->validarRucSociedadPublica($identificacion)) {
            $out_cod = 7; 
            $out_msj = 'RUC válido Sociedad Publica';
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        } else {
            $out_cod = 6; 
            $out_msj = 'RUC incorrecto: '.$validador->getError();
     
            $miArray = array('out_cod'=>$out_cod, 'out_msj'=>$out_msj);
            return response()->json(['data' => $miArray], 200);
        }
        
    }
    
}