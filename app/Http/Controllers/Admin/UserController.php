<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public static $collaborator = 'App\\Models\\Collaborator';
    public function __construct(){

        $this->middleware('can:Administrar usuarios');
    }

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
        $roles = Role::orderBy('id', 'asc')->pluck('name','id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $date = Carbon::now();

        $request->validate([
            'identification' => ['required', 'string', 'max:25', 'unique:collaborators,identification'],
            'phone' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['min:8', 'confirmed']
        ], 
        [
            'identification.required'   => 'El número de cédula es necesario.',
            'identification.unique'     => 'La cédula ya se encuentra registrada.',
            'phone.required'            => 'El número de teléfono es necesario.',
            'sex.required'              => 'El campo sexo es necesario.',
            'birth_day.required'        => 'La fecha de nacimiento es necesaria.',
            'password.min'              => 'La contraseña debe contener al menos 8 caracteres.',
            'password.confirmed'        => 'La confirmación de contraseña no coincide.',
            'email.unique'              => 'El correo ya se encuentra registrado.',
        ]);

        DB::transaction(function () use ($request,$date) {
            return tap(User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'email_verified_at' => $date,
            ]),function (User $user) use ($request) {
                // $this->createCollaborator($user,$request);
                $user->userCollaboratorModel()->save(Collaborator::forceCreate([
                    'user_id' => $user->id,
                    'identification' =>$request['identification'],
                    'name' =>   $request['name'],
                    'phone' =>  $request['phone'],
                    'birth_date' =>  $request['birth_date'],
                    'sex'   =>  $request['sex'],
                ]));  

                $user->roles()->sync($request->rol);
                
            });
        });

        return redirect()->route('admin.users.index')
        ->with('status','El usuario se creó correctamente.');

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

        $colaborador = Collaborator::where('user_id', $user->id)->first();
        
        $roles = Role::orderBy('id', 'asc')->pluck('name','id');

        $roleUser = $user->roles()->first(); 

        return view('admin.users.edit', compact('user','roles','colaborador','roleUser'));
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
        $colaborador = Collaborator::where('user_id', $user->id)->first();
       
        $request->validate([
            'identification' => ['required', 'string', 'max:25', 'unique:collaborators,identification,'.$colaborador->id,],
            'phone' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id,],
        ], 
        [
            'identification.required'   => 'El número de cédula es necesario.',
            'identification.unique'     => 'El usuario ya se encuentra registrado.',
            'phone.required'            => 'El número de teléfono es necesario.',
            'sex.required'              => 'El campo sexo es necesario.',
            'birth_day.required'        => 'La fecha de nacimiento es necesaria.',
            'email.required'            => 'Debe ingresar el correo',
            'email.unique'              => 'El correo ya se encuentra registrado.',
        ]);

        $user->update([
            'name'          => $request->name,
            'email'        => $request->email,
        ]); 
        
        $colaborador->update([
            'identification' => $request->identification,
            'phone'         =>$request->phone,
            'birth_date'    =>$request->birth_date,
            'sex'           =>$request->sex,
        ]); 
        
        //Usar relación de usuario con roles
        $user->roles()->sync($request->rol);
        
        //Redireccionar a ruta del rol
        return redirect()->route('admin.users.index',$user)
            ->with('status','El usuario '.$user->name.' se actualizó correctamente');
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

    public function cambiarPassword(User $user){

        return view('admin.users.pass', compact('user'));
    }

    public function updatePassword(Request $request, User $user){

        $request->validate([
            'password' => ['min:8', 'confirmed']
        ], 
        [
            'password.min'              => 'La contraseña debe contener al menos 8 caracteres.',
            'password.confirmed'        => 'La confirmación de contraseña no coincide.',
        ]);
        
        $password = bcrypt($request->password);

        $user->update([  
            'password' => $password,
        ]);

        return redirect()->route('admin.users.edit', $user)
        ->with('status','Contraseña actualizada');

    }

}