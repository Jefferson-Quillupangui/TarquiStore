<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct(){

        $this->middleware('can:Administrar roles');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
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
            'name' => 'required',
            'name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ], 
        [
            'name.required' => 'Escriba el nombre del rol',
            'name.unique' => 'El nombre del rol ya existe',
            'permissions.required' => 'Ingrese los permisos para asignar al rol'
        ]);
        
        //Crear rol
        $role = Role::create([
            'name' => $request->name
        ]);

        //Insertar rol con los permisos
        $role->permissions()->attach($request->permissions);

        return redirect()->route('admin.roles.index')->with('status','El rol se creó correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'permissions' => 'required'
        // ], 
        // [
        //     'name.required' => 'Escriba el nombre del rol',
        //     'permissions.required' => 'Ingrese los permisos para asignar al rol'
        // ]);

        $request->validate([
            'name' => 'required',
            'name' => 'required|unique:roles,name,'.$role->id,
            'permissions' => 'required'
        ], 
        [
            'name.required' => 'Escriba el nombre del rol',
            'name.unique' => 'El nombre del rol ya existe',
            'permissions.required' => 'Ingrese los permisos para asignar al rol'
        ]);

        //Actualizar nombre del rol
        $role->update([
            'name' => $request->name
        ]); 

        //Elimina permisos de un rol y vuelve a ingresar los que hayan seleccionado
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index')->with('status','El rol se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        
        return redirect()->route('admin.roles.index')->with('status','El rol se elimino correctamente.');
    }
}
