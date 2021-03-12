@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('css')
    <link href="{{ asset('/jquery_toast_plugin/css/jquery.toast.css') }}" rel="stylesheet">
    <style>
        #imagep {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        }
    </style>
@stop

@section('content_header')
    <h1></h1>
@stop

@section('content')

    <x-guest-layout>
        <form action="{{ route('validar.identificacion') }}" id="form-validar-identificacion" class="d-none"></form>

        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-AppRegister />
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                
                <div>
                    <x-jet-label for="identification" value="{{ __('Cédula') }}" />
                    <x-jet-input id="identification" class="block mt-1 w-full" type="number" name="identification"
                        :value="old('identification')" required autofocus autocomplete="identification" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    maxlength="255" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" autofocus autocomplete="name" />
                </div>

                <div class="flex flex-row ... mt-4">
                    <div>
                        <x-jet-label for="birth_date" value="{{ __('Fecha de nacimiento') }}" />
                        <x-jet-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                            :value="old('birth_date')" required autofocus />
                    </div>
                    <div>
                        <x-jet-label for="sex" class="ml-3 mx-16" value="{{ __('Sexo') }}" />
                        <select name="sex" id="sex"
                            class="border-gray-300 ml-3 mx-16 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                            required>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <x-jet-label for="phone" value="{{ __('Teléfono') }}" />
                    <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')"
                        required autofocus autocomplete="phone" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="rol" value="{{ __('Rol') }}" />
                    {!! Form::select('rol', $roles,0,['class' => 'custom-select', 'required' => true]) !!}
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    maxlength="255" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"  href="{{route('admin.users.index')}}">
                            <i class="fas fa-long-arrow-alt-left pr-2"></i>Regresar  
                    </a>
                    <x-jet-button class="ml-4" disabled="disabled" id="btn-registar">
                        {{ __('Guardar') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </x-guest-layout>
    
@stop

                                                                   

@section('js')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/jquery_toast_plugin/js/jquery.toast.js') }}"></script>

<script type="text/javascript">
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
                    $('#btn-registar').prop('disabled', false);
                   // document.getElementById('btn-guardar').disabled = false;
                    $.toast({
                        heading: 'Success',
                        text: obj.out_msj,
                        showHideTransition: 'fade',
                        icon: 'success',
                        position: 'top-right'
                    })

                } else if (obj.out_cod === 6) {
                    $('#btn-registar').prop('disabled', true);
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