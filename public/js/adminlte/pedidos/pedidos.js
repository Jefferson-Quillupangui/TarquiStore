$(document).ready(function () {

    $(document).on("click", "#btn-generarorden",function(){
        $('.loaders').removeClass('d-none');
        $.ajax(
            {
              url : $('#form-crearorden').attr("action"),
              type: "POST",
              data : {
                _token: $('#token').val(),
                opcion: 'AA', 
                clienteid: $('#textbuscarcliente').attr("codigocliente"),
                totalord: 22,
                addresdelivery:  $('#textaddressdelivery').val(),
              }
            })
              .done(function(dt) {
               //console.log(data);    
                //$("#respuesta").html(data);
                if(dt.data[0].out_cod === 7){
                    $('.loaders').addClass('d-none');
                    Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: dt.data[0].out_msj+" Nro Orden: 000"+dt.data[0].out_id_order,
                         showConfirmButton: false,
                         timer: 1500
                        })}
                else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: 'Error 07 al crear orden'
                            })
                }
                })
              .fail(function(data) {
                console.log(data);    
                //alert( "error" );
                $('.loaders').addClass('d-none');
                if(data.status===500){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al crear orden'
                  })}
              })
              .always(function(data) {
                $('.loaders').addClass('d-none');
                //console.log(data);    
                //alert( "complete" );
              });

       
       

    }); 

    $(document).on("click", "#btn-buscarpersona",function(){

        cargarClientes();
        $("#modal-buscarpersona").modal("show");
    });
    $(document).on("click", "#btn-cancelar-pedido",function(){
        $("#modal-buscarpersona").modal("hide");
    });

    
    //custom formatter definition
    var printIcon = function(cell, formatterParams, onRendered){ //plain text value
        return "<i class='fas fa-check'></i>";
    };

    function cargarClientes(){
        var table = new Tabulator("#clientes-table", {
            height:"311px",
            layout:"fitColumns",
            ajaxURL:  $('#form-listarclientes').attr("action"),
            ajaxProgressiveLoad:"scroll",
            paginationSize:20,
            placeholder:"No hay datos que mostrar",
            columns:[
                {formatter:printIcon, width:40, hozAlign:"center", 
                    cellClick:function(e, cell){
                                //alert("Printing row data for: " + cell.getRow().getData().name)
                               // console.log(cell.getRow().getData());
                                $("#textidentification").val(cell.getRow().getData().identification);
                                $("#textbuscarcliente").val(cell.getRow().getData().name);
                                $("#textaddressdelivery").val(cell.getRow().getData().address);
                                $("#textbuscarcliente").attr("codigocliente", cell.getRow().getData().id);
                                $("#modal-buscarpersona").modal("hide");
                            }},
                {title:"ID", field:"id", sorter:"string", width:130, headerFilter:"input",visible:false},
                {title:"Identificación", field:"identification", sorter:"string", width:130, headerFilter:"input"},
                {title:"Nombre", field:"name", sorter:"string", width:200, headerFilter:"input"},
                {title:"Apellidos", field:"last_name", sorter:"string", width:200, headerFilter:"input"},
                {title:"Dirección", field:"address", sorter:"string", width:200, headerFilter:"input" },
                {title:"Telefono1", field:"phone1", sorter:"string", width:200, headerFilter:"input"},
                {title:"Telefono2", field:"phone2", sorter:"string", width:200, headerFilter:"input"},
                {title:"Email", field:"email", sorter:"string", width:200, headerFilter:"input"},
                {title:"Tipo de documento", field:"tipo_documento", sorter:"string", width:200, headerFilter:"input"},
              
            ],
        });
    }
   
});