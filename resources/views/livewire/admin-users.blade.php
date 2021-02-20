<div>
    <div class="card">

        {{-- <div wire:keydown="limpiar_page" wire:model="search" class="card-header">
            <input class="form-control w-100" placeholder="Buscar usuario por nombre o por correo">
        </div> --}}


        @if($users->count())

            <div class="card-body">
                <table class="table table-striped" id="usuarios">
                    <thead style="background-color:#17A2B8;color:white;">
                        <tr>
                            <th>Cod</th>
                            <th>Nombre</th>
                            <th>Foto</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)

                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    @if($user->profile_photo_path)
                                        <img src="{{ asset("storage/".$user->profile_photo_path) }}">
                                    @else
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ3tYRm6oxtL_4-zSGVjtGyHZ5wfH1FsU1ZPQ&usqp=CAU">
                                    @endif
                                </td>
                                {{-- <td><img src="{{ asset($user->profile_photo_path) }}"  height="100"/></td> --}}
                                <td>{{$user->email}}</td>
                                <td>{{$user->getRoleNames()->implode(',')}}</td>
                                <td>
                                    <div class="row ml-4">
                                        <a class="btn btn-secondary" href="{{route('admin.users.edit', $user)}}"><i class="fas fa-edit"></i></a>
                                    </div>
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
