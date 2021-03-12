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

    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script> --}}
    <script type="text/javascript">

        function check(e,value){
            //Validar numero y punto
                var unicode=e.charCode? e.charCode : e.keyCode;
                if (value.indexOf(".") != -1)if( unicode == 46 )return false;
                if (unicode!=8)if((unicode<48||unicode>57)&&unicode!=46)return false;
            }
            function checkLength(){
            var fieldVal = document.getElementById('in_discount_porcent').value;
            //Menos de 3 digitos
            if(fieldVal < 99){
                return true;
            }
            else
            {
            var str = document.getElementById('in_discount_porcent').value;
            str = str.substring(0, str.length - 1);
            document.getElementById('in_discount_porcent').value = str;
            }
        }

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