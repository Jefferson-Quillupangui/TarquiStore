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
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Roles</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)

                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                {{-- <td><img src="{{ asset($user->profile_photo_path) }}"  height="100"/></td> --}}
                                <td>{{$user->email}}</td>
                                <td>@if($user->status=='A') Activo @else Inactivo @endif </td>
                                <td>{{$user->getRoleNames()->implode(', ')}}</td>
                                <td class="text-center border-0">

                                    @if($user->id <> 1)
                                        @if($user->status=='A')
                                        <form action="{{route('admin.user.status', $user)}}" method="GET" class="op-desactivar">
                                            @csrf
                                            <div class="btn-group">
                                                <a class="btn btn-info btn-group-sm" href="{{route('admin.users.show',$user)}}"><i class="far fa-eye"></i></a>
                                                <a class="btn btn-secondary btn-group-sm" href="{{route('admin.users.edit', $user)}}"><i class="fas fa-edit"></i></a>
                                                <button class="btn btn-danger" type="submit"><i class="far fa-times-circle"></i> Desactivar</button>
                                            </div>
                                        </form>
                                        @else
                                        <form action="{{route('admin.user.status', $user)}}" method="GET" class="op-activar">
                                            @csrf
                                            <div class="btn-group">
                                                <a class="btn btn-info btn-group-sm" href="{{route('admin.users.show',$user)}}"><i class="far fa-eye"></i></a>
                                                <a class="btn btn-secondary btn-group-sm" href="{{route('admin.users.edit', $user)}}"><i class="fas fa-edit"></i></a>
                                                <button class="btn btn-primary btn-group-sm pr-4" type="submit"><i class="far fa-check-circle"></i> Activar&nbsp;&nbsp;</button>
                                            </div>
                                        </form>
                                        @endif
                                    @endif       

                                    {{-- <form action="{{route('admin.user.status', $user)}}" method="GET" class="op-desactivar" data-id="$user['name']">
                                        @csrf
                                        <div class="btn-group">
                                            <a class="btn btn-info btn-group-sm" href="{{route('admin.users.show',$user)}}"><i class="far fa-eye"></i></a>
                                            <a class="btn btn-secondary btn-group-sm" href="{{route('admin.users.edit', $user)}}"><i class="fas fa-edit"></i></a>
                                            @if($user->status=='A')
                                                <button class="btn btn-danger" type="submit">Desactivar</button>
                                            @else
                                                <a class="btn btn-primary btn-group-sm pr-4" href="{{route('admin.user.status', $user)}}">Activar&nbsp;&nbsp;</a>
                                            @endif
                                        </div>
                                    </form> --}}

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
