<?php
namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GeneralesClass {


    public static function verificarPermisoAdministrador(){

        $id = Auth::user()->id;

        $user = User::find($id); 

        $permission = $user->getPermissionsViaRoles();

        $nombrePermisoBuscado = "Administrar pedidos";
        $administrarPedido = 0;//no encontrado

        foreach ($permission as $key => $object) {
            $nombrePermisoObtenido = $object->name;

            if (strcmp ($nombrePermisoObtenido , $nombrePermisoBuscado ) == 0) { 
                $administrarPedido = 1;//encontrado
                break;
            }
           
        }
        
        return $administrarPedido;
    }


}