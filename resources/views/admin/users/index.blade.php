@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('css')
 <!-- CCS DATA TABLE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Correo</th>
                    <th>Incorporacion</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script>
         $('#usuarios').DataTable(

         );
    </script>
@stop