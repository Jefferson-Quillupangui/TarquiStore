$(document).ready(function () {

    /**
     * PROCESO PARA Guardar
     */

    if( $('#btn-guardar').attr('guardar') === "1"){
        window.onload = procesoGuardar();
        //4 validarDocumento( $('#input-identificacion').val(), $('#input-tipo-identificacion').val()  );
    } 


    function procesoGuardar(){

        //como revisar si un checkbox está activado en JQuery
        //y obtener su valor
        var checkBox;
        if( ( checkBox = $(".check-no-aplica-identificacion").val() ) == "on" ){
            //esta el check activo (ingresar cedula y validar)
            $('#btn-guardar').prop('disabled', true);
        }

    }

    // check-no-aplica-identificacion

    //$('.check-no-aplica-identificacion').on('change', function(e){

   
    $(document).on("change", ".check-no-aplica-identificacion",function(){
        if (this.checked) {
            //alert("checked-Aplica");
            //caso de que si ingrese cedula
            $('#input-identificacion').prop('readonly', false);
            $('#input-tipo-identificacion').prop('disabled', false);
            $('#btn-guardar').prop('disabled', true);
            aceptarValidacionCedula();

            if( $('#btn-guardar').attr('editar') === "0"){
                $('#input-tipo-identificacion').prop('disabled', false);
            }
          
        } else {
            //alert("unchecked-NoAplica");
              //caso de q no quieran ingresar cedula
            $('#input-identificacion').attr("verificacion", 1);
            document.getElementById("input-identificacion").value = "";
            $('#input-tipo-identificacion').val('05').change();
            $('#input-identificacion').prop('readonly', true);
            $('#input-tipo-identificacion').prop('disabled', true);
            $('#btn-guardar').prop('disabled', false);

        }
    });


   


    $(document).on("change", "#input-identificacion",function(){
        var $txt_identificacion = $('#input-identificacion').val();
        var $verificar = $('#input-identificacion').attr("verificacion");
        var $txt_tipo_identificacion = $('#input-tipo-identificacion').val();
        
        validarDocumento( $txt_identificacion, $txt_tipo_identificacion , $verificar )
    
    });
    // $('#btn-guardar').prop('disabled', true);

    // $(document).on("change", "#input-identificacion",function(){
    //     var $txt_identificacion = $('#input-identificacion').val();
    //     var $txt_tipo_identificacion = $('#input-tipo-identificacion').val();


    //     validarDocumento( $txt_identificacion, $txt_tipo_identificacion  )

    // });


    function validarDocumento( $txt_identificacion, $txt_tipo_identificacion, $verificar ){
        if($verificar === 0 || $verificar === "0"){
            $.ajax({
                type: 'GET',
                url: $('#form-validar-identificacion').attr("action"),
                 data: {
                     identificacion: $txt_identificacion,
                     tipoDocumt : $txt_tipo_identificacion
                 },
                // dataType: "dataType",
                beforeSend: function () {
                   // $('.loaders').removeClass('d-none');
                },
                success: function (response) {
                   //console.log(response.data);
                    let obj = response.data;
                   if(obj.out_cod === 7 ){
                    $('#btn-guardar').prop('disabled', false);
                   // document.getElementById('btn-guardar').disabled=false;
                        $.toast({
                            heading: 'Success',
                            text: obj.out_msj,
                            showHideTransition: 'fade',
                            icon: 'success',
                            position: 'top-right'
                        })
                       
                   }else if(obj.out_cod === 6 ){
                    $('#btn-guardar').prop('disabled', true);
                   // document.getElementById('btn-guardar').disabled=true;
                        $.toast({
                            heading: 'Error',
                            text: obj.out_msj,
                            showHideTransition: 'fade',
                            icon: 'error',
                            position: 'top-right'
                        })
                    }
               
                }, complete: function () {
                    // $('.loaders').addClass('d-none');
                }
            });
        }
       
    }


    $(document).on("change", "#input-tipo-identificacion",function(){
        var $txt_identificacion = $('#input-identificacion').val();
        var $txt_tipo_identificacion = $('#input-tipo-identificacion').val();
        var $verificar = $('#input-identificacion').attr("verificacion");

        validarDocumento( $txt_identificacion, $txt_tipo_identificacion, $verificar )

    });


    function aceptarValidacionCedula(){
       
    }

    /**
     * PROCESO PARA ACTUALIZAR
     */
    if( $('#btn-guardar').attr('editar') === "0")
    { 
        window.onload =  editar();


        function editar(){
           let $identificacion =  $('#input-identificacion').val();
           let $tipoIdentificacion =  $('#input-tipo-identificacion').val();
           var $verificar = $('#input-identificacion').attr("verificacion");

           if($identificacion === ""){
            $('#input-identificacion').prop('readonly', true);
            $('#input-tipo-identificacion').prop('disabled', true);
            $(".check-no-aplica-identificacion").removeAttr("checked");
            //$('#input-tipo-identificacion').prop('checked', false);
           }else{
            validarDocumento( $identificacion, $tipoIdentificacion, $verificar  );
           }
            
        }
    }
   
    
    

});