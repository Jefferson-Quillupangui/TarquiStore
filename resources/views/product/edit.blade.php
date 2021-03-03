@extends('adminlte::page')

@section('title', 'TarquiStore')

@section('content_header')
    <h1><i class="fas fa-pencil-alt"></i> Editar producto</h1>
@stop

@section('content')

    @include('partials.session-status')
    
    <div class="card">
        <div class="card-body">
            {!! Form::model($product,['route' => ['products.update', $product], 'method' => 'put','files' => true]) !!}
                
            @include('product.partials.form')  

                {!! Form::submit('Actualizar', ['class' => 'btn btn-info mt-2']) !!}  
                
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

        var select_price = $("#select_price_discount").val()
        $('#in_price_discount').val(select_price).change();

        var select_porcent = $("#select_porcent_desc").val()
        $('#in_discount_porcent').val(select_porcent).change();

        $(document).ready(function () {
            
            var select_id_category = $("#select_id_category").val()
            $('#select_id_cat').val(select_id_category).change();

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

        $(document).ready(function(){

        $('#file').change(function(e){

        let file= e.target.files[0];
        let reader= new FileReader();

        if(e.target.files[0]) {
        reader.onload= (event) => {

            $('#picture').attr('src', event.target.result)

        };

            reader.readAsDataURL(file);
            
        }else{

            $('#picture').attr('src', "https://fesu.edu.co/wp-content/themes/simbolo/assets/images/no-icono.png");
        }

        })

        });

      
    </script>
@stop