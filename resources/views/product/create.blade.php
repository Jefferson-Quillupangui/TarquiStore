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

        // ClassicEditor
        // .create( document.querySelector( '#descript' ) )
        // .catch( error => {
        //     console.error( error );
        // } );

        // //Cambiar imagen
        
        // document.getElementById("image").addEventListener('change', cambiarImagen);

        // function cambiarImagen(event){
        //     var file = event.target.files[0];

        //     var reader = new FileReader();
        //     reader.onload = (event) => {
        //         document.getElementById("picture").setAttribute('src', event.target.result); 
        //     };

        //     reader.readAsDataURL(file);
        // }

        $(document).ready(function(){

                $('#file').change(function(e){

                    let file= e.target.files[0];

                    let reader= new FileReader();

                reader.onload= (event) => {

                    $('#picture').attr('src', event.target.result)

                };

                    reader.readAsDataURL(file);

                })

            });
        // document.getElementById("file").onchange = function(e) {
        // // Creamos el objeto de la clase FileReader
        // let reader = new FileReader();

        // // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        // reader.readAsDataURL(e.target.files[0]);

        // // Le decimos que cuando este listo ejecute el código interno
        // reader.onload = function(){
        //     let preview = document.getElementById('preview'),
        //             image = document.createElement('img');

        //     image.src = reader.result;

        //     preview.innerHTML = '';
        //     preview.append(image);
        // };
        // }

    </script>
@stop