<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\TypeIdentification;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $clients = Client::simplePaginate(5);       
        return view('clientes.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_identification = TypeIdentification::orderBy('id', 'asc')->pluck('name','id');
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
        if($request->identification==null){

            $this->validaIdentificacionNull($request);

        }else{

            $this->validaIdentificacionUniq($request);

        }

        //Crear categoria
        $client = Client::create([
            'identification'    => $request->identification,
            'name'              => $request->name,
            'last_name'         => $request->last_name,
            'address'           => $request->address,
            'phone1'            => $request->phone1,
            'phone2'            => $request->phone2,
            'email'             => $request->email,
            'type_identification_id' => $request->type_identification,
        ]);

        return redirect()->route('clients.index')
                    ->with('status','El cliente se registró correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $type_identification = TypeIdentification::orderBy('id', 'asc')->pluck('name','id');
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
        if($request->identification==null){

            $this->validaIdentificacionNull($request);

        }else{
            if($request->identification == $client->identification){
               
                $this->validaIdentificacionNull($request);
                
                $client->update([
                    'name'              => $request->name,
                    'last_name'         => $request->last_name,
                    'address'           => $request->address,
                    'phone1'            => $request->phone1,
                    'phone2'            => $request->phone2,
                    'email'             => $request->email,
                    'type_identification_id' => $request->type_identification,
                ]);
            }else{
                $this->validaIdentificacionUniq($request);
            }
        }

        //Actualizar datos en la tabla
        $client->update([
            'identification'    => $request->identification,
            'name'              => $request->name,
            'last_name'         => $request->last_name,
            'address'           => $request->address,
            'phone1'            => $request->phone1,
            'phone2'            => $request->phone2,
            'email'             => $request->email,
            'type_identification_id' => $request->type_identification,
        ]);

        return redirect()->route('clients.edit',$client)
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

    public function validaIdentificacionUniq(Request $request){

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
    }

    public function validaIdentificacionNull(Request $request){

        $request->validate([
            'name'                      => 'required',
            'last_name'                 => 'required',
            'address'                   => 'required',
            'phone1'                    => 'required',
            'type_identification'       => 'required',
        ], 
        [
            'name.required'                 => 'Ingrese el nombre del cliente',
            'last_name.required'            => 'Ingrese el apellido del cliente',
            'address.required'              => 'Ingrese la dirección del cliente',
            'phone1.required'               => 'Ingrese un teléfono de contacto',
            'type_identification.required'  => 'Ingrese un tipo de identificación',

        ]);
    }

}