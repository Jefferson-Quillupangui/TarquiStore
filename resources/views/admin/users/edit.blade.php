@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link href="{{ asset('/jquery_toast_plugin/css/jquery.toast.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("datatables/css/bootstrap.css") }}">
@stop

@section('content_header')
    <h1><i class="fas fa-pencil-alt"></i> Editar Usuario</h1>
@stop

@section('content')

@include('partials.session-status')

<form action="{{ route('validar.identificacion') }}" id="form-validar-identificacion" class="d-none"></form>

    <div class="card">
        <div class="card-body">
            
            {{-- <h1 class="h5">Nombre</h1>
            <p class="form-control col-md-6" >{{$user->name}}</p> --}}
            
                     
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put' ]) !!}

                <div class="form-group">

                    <div class="row">
                        <div class="col-md-5">
                            <label for="name">Nombre</label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="far fa-list-alt"></i></span>
                                </div>
                            {!! Form::text('name',null,['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del usuario', 'required' => true]) !!}
                            </div> 

                        </div>

                        <div class="col-md-5">
                            <label for="identification">Identificación</label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-card-alt"></i></span>
                                </div>
                            {!! Form::number('identification',$colaborador->identification,['class' => 'form-control' . ($errors->has('identification') ? ' is-invalid' : ''), 'placeholder' => 'Identificación del usuario', 'id' => 'identification' ,  'required' => true]) !!}            
                            @error('identification')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror 
                            </div>  
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="birth_date">Fecha de nacimiento</label>

                            <div class="input-group mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar-day"></i>
                                        </span>
                                    </div>
                                    <input name="birth_date" type="date" class="form-control" id="birth_date" value="{{old('birth_date', $colaborador->birth_date)}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="sex">Sexo</label>
                            {!! Form::select('sex', ['H' => 'Hombre', 'M' => 'Mujer'] ,$colaborador->sex,['class' => 'custom-select', 'required' => true, 'id' => 'select_sex']) !!}
                        </div>

                        <div class="col-md-5">
                            <label for="phone">Teléfono</label>
                            <div class="input-group mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    {!! Form::number('phone', $colaborador->phone,['class' => 'form-control', 'placeholder' => 'Teléfono de contacto', 'required' => true,] )!!}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-5">
                            <label for="email">Correo</label>
                            <div class="input-group mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    {!! Form::email('email', $user->email,['class' => 'form-control'. ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo del usuario', 'required' => true,] )!!}
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="birth_date">Rol</label>
                            <div class="input-group mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                                    </div>
                                    {!! Form::select('rol', $roles, $roleUser->id ,['class' => 'custom-select', 'required' => true, 'id' => 'select_id_cat']) !!}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-5">
                            <a class="btn btn-secondary btn-group-sm" href="{{route('admin.user.pass', $user)}}"><i class="fas fa-key"></i> Cambiar Contraseña</a>
                        </div>
                    </div>
                    

                </div>               

                {!! Form::submit('Actualizar', ['class' => 'btn btn-info mt-2', 'id' => 'btn-actualizar']) !!}  

                <a class="btn btn-link "
                href="{{ route('admin.users.index') }}">
                <i class="fas fa-arrow-circle-left"></i>
                Regresar
                </a>  

            {!! Form::close() !!}


            

        </div>
    </div>
@stop

@section('js')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/jquery_toast_plugin/js/jquery.toast.js') }}"></script>

<script type="text/javascript">
    

    // $(window).on('load', function() {
    //     var $txt_identificacion = $('#identification').val();
    //     var $txt_tipo_identificacion = '05'; //$('#input-tipo-identificacion').val();


    //     validarDocumento($txt_identificacion, $txt_tipo_identificacion)
    // })

    $(document).on("change", "#identification", function() {
        var $txt_identificacion = $('#identification').val();
        var $txt_tipo_identificacion = '05'; //$('#input-tipo-identificacion').val();


        validarDocumento($txt_identificacion, $txt_tipo_identificacion)

    });


    function validarDocumento($txt_identificacion, $txt_tipo_identificacion) {
        $.ajax({
            type: 'GET',
            url: $('#form-validar-identificacion').attr("action"),
            data: {
                identificacion: $txt_identificacion,
                tipoDocumt: $txt_tipo_identificacion
            },
            // dataType: "dataType",
            beforeSend: function() {
                // $('.loaders').removeClass('d-none');
            },
            success: function(response) {
                //console.log(response.data);
                let obj = response.data;
                if (obj.out_cod === 7) {
                    $('#btn-actualizar').prop('disabled', false);
                   // document.getElementById('btn-guardar').disabled = false;
                    $.toast({
                        heading: 'Success',
                        text: obj.out_msj,
                        showHideTransition: 'fade',
                        icon: 'success',
                        position: 'top-right'
                    })

                } else if (obj.out_cod === 6) {
                    $('#btn-actualizar').prop('disabled', true);
                   // document.getElementById('btn-guardar').disabled = true;
                    $.toast({
                        heading: 'Error',
                        text: obj.out_msj,
                        showHideTransition: 'fade',
                        icon: 'error',
                        position: 'top-right'
                    })
                }

            },
            complete: function() {
                // $('.loaders').addClass('d-none');
            }
        });
    }

</script>
@stop