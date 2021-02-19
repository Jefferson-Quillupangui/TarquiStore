$(document).ready(function () {

    $(document).on("click", "#generar-pdf-orden",function(){



        var id = $("#txt_id_cab_orden").val();
        var url =$("#generar-pdf-orden").attr("href");

        if(id===0 || id==="0"){
            $.toast({
                heading: 'Warning',
                 text: 'Debe Seleccionar una orden',
                 showHideTransition: 'fade',
                 icon: 'warning',
                 position: 'top-right'
             })
        }else{
            var nuevaUrl = url .replace('0', id);
            $("#generar-pdf-orden").attr("href",nuevaUrl);
        }

       
 
    });



    // function downloadFile(response) {
    //     var blob = new Blob([response], {type: 'application/pdf'})
    //     var url = URL.createObjectURL(blob);
    //     location.assign(url);
    //   } 

    // function enviarDatosOrdenPdf(){

    //     $.ajax({
    //         type: 'POST',
    //         url: $('#form-datos-orden').attr("action"),
    //         data: {
    //            // opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
    //            _token: $('#token_orden_busqd').val(),
    //            nombre_estado_ord : $('#txtEstadoOrden').val(),
    //            id : $('#txt_id_cab_orden').val(),
    //            nombre_cliente :$("#txtCliente").val(),
    //            identification : $("#txtIdentificacion").val(),
    //            email : $("#txtEmail").val(),
    //            phone1 : $("#txtPhone1").val(),
    //            phone2 : $("#txtPhone2").val(),
    //            nombre_colaborador : $("#colaborador").val(),
    //            delivery_date : $("#fechaActual").val(),
    //            delivery_time : $("#horaActual").val(),
    //            delivery_address : $("#txtDireccion").val(),
    //            observation : $("#txtObservacion").val(),
    //            nombre_sector : $('#txtSector').val(),
    //            nombre_ciudad : $('#txtCiudad').val(),
    //         }
    //         // $('.loaders').removeClass('d-none');
    //     });
    //     //.done(downloadFile);

    // }
    
    // function enviarDatosOrdenPdf(){
    //     $.ajax({
    //         type: 'POST',
    //         url: $('#form-datos-orden').attr("action"),
    //         data: {
    //            // opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
    //            _token: $('#token_orden_busqd').val(),
    //            nombre_estado_ord : $('#txtEstadoOrden').val(),
    //            id : $('#txt_id_cab_orden').val(),
    //            nombre_cliente :$("#txtCliente").val(),
    //            identification : $("#txtIdentificacion").val(),
    //            email : $("#txtEmail").val(),
    //            phone1 : $("#txtPhone1").val(),
    //            phone2 : $("#txtPhone2").val(),
    //            nombre_colaborador : $("#colaborador").val(),
    //            delivery_date : $("#fechaActual").val(),
    //            delivery_time : $("#horaActual").val(),
    //            delivery_address : $("#txtDireccion").val(),
    //            observation : $("#txtObservacion").val(),
    //            nombre_sector : $('#txtSector').val(),
    //            nombre_ciudad : $('#txtCiudad').val(),
    //         },
    //         // dataType: "dataType",
    //         beforeSend: function () {
    //             $('.loaders').removeClass('d-none');
              
    //         },
    //         // success: function (response) {
              
    
    //         // //     // if (response === 0) {
    //         // //     //     Swal.fire({
    //         // //     //         icon: 'error',
    //         // //     //         title: 'Alerta!',
    //         // //     //         text: 'No Exite Registro!'
    //         // //     //         //footer: '<a href>Why do I have this issue?</a>'
    //         // //     //     });
    //         // //     // } else {
    
    //         // //    table_lista_ordenes.replaceData(response.data);
    //         // //     //     tab_producto = new FancyGrid.get('tb-producto-modal');
    //         // //     //     tab_producto.setData(response);
    //         // //     //     tab_producto.update();
    //         // //     //     tab_producto.show();
    //         // //     // }
    
    
    //         // }, 
    //         complete: function () {
    //             $('.loaders').addClass('d-none');
              
    //         }
    //     });
    // }

});