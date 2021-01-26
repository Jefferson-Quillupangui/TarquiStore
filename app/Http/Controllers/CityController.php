<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitySale;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = CitySale::all();

        return view('ciudad.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = new CitySale;
        return view('ciudad.create', compact('city'));
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
            'name' => 'required|unique:city_sales,name'
        ],
        [
            'name.required' => 'El nombre de la ciudad es requerido',
            'name.unique' => 'El nombre de la ciudad ya existe'
        ]);
        
        $city = CitySale::create([
            'name' => ucwords(strtolower($request->name)),
        ]);

        return redirect()->route('ciudades.index')->with('status','La ciudad se creó correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CitySale $city)
    {
        return view('ciudad.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CitySale $city)
    {
        //Validación de datos
        $request->validate([
            'name' => 'required|unique:city_sales,name'
        ],
        [
            'name.required' => 'El nombre de la ciudad es requerido',
            'name.unique' => 'El nombre de la ciudad ya existe'
        ]);

        //Actualizar datos en la tabla
        $city->update([
            'name' => ucwords(strtolower($request->name)),
        ]);

        return redirect()->route('ciudades.index')->with('status','La ciudad se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citysale $city)
    {
        $city->delete();
        
        return redirect()->route('ciudades.index')->with('status','La ciudad se eliminó correctamente.');
    }
}
