<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TypeIdentification;

class TypesIdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_identifications = TypeIdentification::all();

        return view('typeidentification.index', compact('type_identifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_identification = new TypeIdentification;

        return view('typeidentification.create',compact('type_identification'));
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
            'name'          => 'required|unique:type_identifications,name',
        ],[
            'name.required'         => 'Ingrese el nombre del tipo de identifición',
            'name.unique'           => 'El nombre del tipo de identifición ya existe',
        ]);

        $type_identification = TypeIdentification::create([
            'name' => strtoupper($request->name)
        ]);

        return redirect()->route('type_identification.index')->with('status','El tipo de indentificación se creó correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeIdentification $type_identification)
    {
        return view('typeidentification.edit',compact('type_identification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TypeIdentification $type_identification)
    {
        //Validar el nombre
        
        if($request->name == $type_identification->name){

            $request->validate([
                'name'          => 'required',
            ],[
                'name.required'         => 'Ingrese el nombre del tipo de identifición',
            ]);   

        }else{

            $request->validate([
                'name'          => 'required|unique:type_identifications,name',
            ],[
                'name.required'         => 'Ingrese el nombre del tipo de identifición',
                'name.unique'           => 'El nombre del tipo de identifición ya existe',
            ]);               
        }

        //Actualizar datos en la tabla
        $type_identification->update([
            'name'          => strtoupper($request->name)
        ]);

        return redirect()->route('type_identification.index')
                    ->with('status','El tipo de identificación se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeIdentification $type_identification)
    {
        
        $type_identification->delete();
        
        return redirect()->route('type_identification.index')
                ->with('status','El tipo de orden se eliminó correctamente.');
    }
}
