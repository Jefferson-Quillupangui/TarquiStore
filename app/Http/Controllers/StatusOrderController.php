<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStatus;

class StatusOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
      $statuses_sorder = OrderStatus::all();

      return view('statusorder.index',compact('statuses_sorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status_order = new OrderStatus;
        return view('statusorder.create',compact('status_order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo'          => 'required|unique:order_statuses,codigo',
            'name'          => 'required|unique:order_statuses,name',
            'description'   => 'required'
        ],[
            'codigo.required'         => 'Ingrese el código del estado',
            'codigo.unique'           => 'El código del estado ya existe',
            'name.required'         => 'Ingrese el nombre del estado',
            'name.unique'           => 'El nombre del estado ya existe',
            'description.required'  => 'Ingrese la descripción del estado'
        ]);

        $status_order = OrderStatus::create([
            'codigo' => strtoupper($request->codigo),
            'name' => ucwords(strtolower($request->name)),
            'description' => $request->description
        ]);

        return redirect()->route('status_order.index')->with('status','El estado de orden se creó correctamente');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $status_order)
    {
        return view('statusorder.edit',compact('status_order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderStatus $status_order)
    {
       //Validar el nombre
        $request->validate([
            'codigo'        => 'required|unique:order_statuses,codigo',//.$status_order->codigo,
            'name'          => 'required|unique:order_statuses,name',//.$status_order->name,
            'description'   => 'required'
        ],[
            'codigo.required'       => 'Ingrese el código del estado',
            'codigo.unique'         => 'El código del estado ya existe',
            'name.required'         => 'Ingrese el nombre del estado',
            'name.unique'           => 'El nombre del estado ya existe',
            'description.required'  => 'Ingrese la descripción del estado'
        ]);

        //Actualizar datos en la tabla
        $status_order->update([
            'codigo'        => strtoupper($request->name),
            'name'          => ucwords(strtolower($request->name)),
            'description'   => $request->description
        ]);

        return redirect()->route('status_order.index')
                    ->with('status','El estado de orden se actualizó correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $status_order)
    {
        $status_order->delete();
        
        return redirect()->route('status_order.index')
                ->with('status','El estado de orden se eliminó correctamente.');
    }
}
