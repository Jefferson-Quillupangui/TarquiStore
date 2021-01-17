<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

use Livewire\WithPagination;

class AdminUsers extends Component
{

    use WithPagination;

    //Mostrar estilos de paginación de bootstrap
    protected $paginationTheme = "bootstrap";

    //Propiedad para realizar la busqueda mediante input
    public $search;

    public function render()

    {
        //Traer listado de usuarios y mostrar paginación
        $users= User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email','LIKE','%' . $this->search . '%')
                ->paginate(8);

        //Pasar los datos al componente
        return view('livewire.admin-users',compact('users'));
    }

    //Limpiar paginación
    public function limpiar_page(){
        $this->reset('page');
    }
}
