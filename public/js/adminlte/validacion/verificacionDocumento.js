$(document).ready(function () {

    $('#btn-guardar').prop('disabled', true);

    $(document).on("change", "#input-identificacion",function(){
        var $txt_identificacion = $('#input-identificacion').val();
        var $txt_tipo_identificacion = $('#input-tipo-identificacion').val();


        validarDocumento( $txt_identificacion, $txt_tipo_identificacion  )

    });


    function validarDocumento( $txt_identificacion, $txt_tipo_identificacion ){
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
                document.getElementById('btn-guardar').disabled=false;
                    $.toast({
                        heading: 'Success',
                        text: obj.out_msj,
                        showHideTransition: 'fade',
                        icon: 'success',
                        position: 'top-right'
                    })
                   
               }else if(obj.out_cod === 6 ){
                $('#btn-guardar').prop('disabled', true);
                document.getElementById('btn-guardar').disabled=true;
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


    $(document).on("change", "#input-tipo-identificacion",function(){
        var $txt_identificacion = $('#input-identificacion').val();
        var $txt_tipo_identificacion = $('#input-tipo-identificacion').val();


        validarDocumento( $txt_identificacion, $txt_tipo_identificacion  )

    });


    if( $('#btn-guardar').attr('editar') === "0")
    { window.onload =  validarDocumento( $('#input-identificacion').val(), $('#input-tipo-identificacion').val()  );}
   
    

});