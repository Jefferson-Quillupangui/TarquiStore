@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1> <i class="fab fa-creative-commons-share"></i> Ingresar producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'products.store', 'method' => 'POST', 'files' => true]) !!}
                
                @include('product.partials.form')  

                {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2']) !!}   
                
                <a class="btn btn-link "
                    href="{{ route('products.index') }}">
                    Regresar
                </a>  

            {!! Form::close() !!}
        </div>    
    </div>    
@stop

@section('css')
    <style  type="text/css">textarea{ resize : none;}</style>
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            
            $(document).on("keyup", "#in_discount_porcent",function(){
            //var desct_pvp = $('#in_price_discount').val();//Precio descuento:
            
            var porcentaje = $('#in_discount_porcent').val();//Porcentaje descuento:  
            var pvp = $('#in_price').val();//Precio:

            var descuento = (parseFloat (pvp)*parseFloat(porcentaje))/100;
            var pvpFinal = parseFloat (pvp)-parseFloat (descuento)

            if (isNaN(pvpFinal)) {
                $('#in_price_discount').val(0.00);
            }else{
                $('#in_price_discount').val(pvpFinal.toFixed(2));
            }

            });
        });
    </script>
@stop