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
        //$type_identifications = TypeIdentification::all();

        $type_identifications = TypeIdentification::where('status', '=', 'A')->get();

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
        
        $valor = $request->validate([
            'codigo'          => 'required|unique:type_identifications,codigo',
            'name'          => 'required|unique:type_identifications,name',
            
        ],[
            'codigo.required'         => 'Ingrese el codigo de identifición',
            'codigo.unique'           => 'El codigo de identifición ya existe',
            'name.unique'           => 'El nombre del tipo de identifición ya existe',
            'name.required'         => 'Ingrese el nombre del tipo de identifición',
           
        ]);

        

        $type_identification = TypeIdentification::create([
            'codigo' => $request->codigo,
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
        $codigo =  $type_identification->codigo;
    //     $codigo = $request->codigo;
    //    $pk_codigo = TypeIdentification::where('codigo',$codigo)->get();
        return view('typeidentification.edit',compact('codigo','type_identification'));
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
        $request->validate([
            'codigo'        => 'required|unique:type_identifications,codigo,'.$type_identification->codigo.',codigo',
            'name'          => 'required|unique:type_identifications,name,'.$type_identification->codigo.',codigo',
            
        ],[
            'codigo.required'       => 'Ingrese el codigo de identifición',
            'codigo.unique'         => 'El codigo de identifición ya existe',
            'name.unique'           => 'El nombre del tipo de identifición ya existe',
            'name.required'         => 'Ingrese el nombre del tipo de identifición',
           
        ]);
        //Actualizar datos en la tabla
        //  TypeIdentification::where("codigo", $type_identification->codigo)->update([
        //         'codigo' => $request->codigo,
        //         'name' => strtoupper($request->name)
        //     ]);
            
        //->update(['name'=> strtoupper($request->name]);

        $type_identification->update([
            'codigo' => $request->codigo,            
            'name'   => strtoupper($request->name)
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
        
        //$type_identification->delete();

        TypeIdentification::where("codigo", $type_identification->codigo)->update([
            'status'          => 'I'
        ]);
        
        return redirect()->route('type_identification.index')
                ->with('status','El tipo de orden se eliminó correctamente.');
    }
}