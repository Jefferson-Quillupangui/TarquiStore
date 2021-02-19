@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1><i class="fas fa-user-cog"></i>Reportes</h1>
@stop

@section('css')

@stop

@section('content')

    @include('partials.session-status')

    <div class="card">

        <div class="card-header">
            <a href="#" class="btn btn-info">
                <i class="fas fa-plus-square"></i> Button
            </a>
        </div>

        <div class="card-body">

        <div class="container">
 <div class="row">
  <div class="col-md-10 col-md-offset-1">
   <div class="panel panel-default">
    <div class="panel-heading">Report</div>
    <div class="panel-body">
     <form class="form-horizontal" role="form" method="POST" action="/pruebaPdf">
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                     <div class="form-group">
                         <div class="col-sm-offset-3 col-sm-5">
                             <button type="submit" class="btn btn-primary">Generate</button>
                         </div>
                     </div>
                 </form>
    </div>
   </div>
  </div>
 </div>
</div>

        </div>
    </div>
@stop

@section('js')

@stop