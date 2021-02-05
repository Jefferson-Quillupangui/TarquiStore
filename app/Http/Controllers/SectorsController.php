<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //$sectors = Sector::all();

        $sectors = Sector::where('status', '=', 'A')->get();

        return view('sector.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sector = new Sector;
        return view('sector.create', compact('sector'));
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
            'name'      => 'required|unique:sectors,name',
            'codigo'    => 'required|unique:sectors,codigo' 

        ],[
            'name.required'     => 'Ingrese el nombre del sector',
            'name.unique'       => 'El nombre del sector ya existe',
            'codigo.required'   => 'Ingrese el código del sector',
            'codigo.unique'     => 'El codigo del sector ya existe',
        ]);

        $sector = Sector::create([
            'codigo' => strtoupper($request->codigo),
            'name' => ucwords(strtolower($request->name)),
        ]);

        return redirect()->route('sectors.index')->with('status','El sector se creó correctamente');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        return view('sector.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Sector $sector)
    {
        $request->validate([
            'codigo'    => 'required|unique:sectors,codigo,'.$sector->codigo.',codigo', 
            'name' => 'required|unique:sectors,name,'.$sector->codigo.',codigo',
        ],[
            'name.required' => 'Ingrese el nombre del sector',
            'name.unique' => 'El nombre del sector ya existe',
            'codigo.required'   => 'Ingrese el código del sector',
            'codigo.unique'     => 'El codigo del sector ya existe',
        ]);
        
        //Actualizar datos en la tabla
        $sector->update([
            'codigo' => strtoupper($request->codigo),
            'name' => ucwords(strtolower($request->name)),
        ]);

        return redirect()->route('sectors.index')->with('status','El sector se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        //$sector->delete();

        //Borrado lógico
        Sector::where("codigo", $sector->codigo)->update([
            'status' => 'I'
        ]);
              
        return redirect()->route('sectors.index')->with('status','El sector se eliminó correctamente.');
    }
}
