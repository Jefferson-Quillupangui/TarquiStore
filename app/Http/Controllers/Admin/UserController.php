<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $users = User::all();
        // $users = User::with('roles')->pluck('name','id');
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
  
        $colaborador = Collaborator::find($user->id);

        $edad = Carbon::createFromDate($colaborador->birth_date)->age;
                
        return view('admin.users.show', compact('user','colaborador','edad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        $roles = Role::all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        //Usar relación de usuario con roles
        $user->roles()->sync($request->roles);
        
        //Redireccionar a ruta del rol
        return redirect()->route('admin.users.index',$user)
            ->with('status','El rol se asignó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function userStatus(User $user){

        if($user->status == 'A'){

            $user->update([
                'status' => 'I', //Inactivar usuario
            ]); 

            return redirect()->route('admin.users.index')
        ->with('status','El usuario '.$user->name.' ha sido desactivado ');
    
        }else{

            $user->update([
                'status' => 'A', //Activar usuario
            ]); 

            return redirect()->route('admin.users.index')
        ->with('status','El usuario '.$user->name.' ha sido activado');

        }

    }

}