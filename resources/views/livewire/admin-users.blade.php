<div>
    <div class="card">

        <div wire:keydown="limpiar_page" wire:model="search" class="card-header">
            <input class="form-control w-100" placeholder="Buscar usuario por nombre o por correo">
        </div>


        @if($users->count())

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)

                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                {{-- <td><img src="{{ asset($user->profile_photo_path) }}"  height="100"/></td> --}}
                                <td>{{$user->email}}</td>
                                <td width="10px">
                                    <a class="btn btn-info" href="{{route('admin.users.edit', $user)}}">Editar</a>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{$users->links()}}
            </div>
        @else 
            <div class="card-body">
                <strong>No se encontraron registros...</strong>
            </div>
        @endif


    </div>
</div>
