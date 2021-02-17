$(document).ready(function () {

    let table_lista_ordenes;

   

    var date = new Date();
    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);

    var datePrimer =
    primerDia.getFullYear() + "-" +
    ("00" + (primerDia.getMonth() + 1)).slice(-2) + "-" +
    ("00" + primerDia.getDate()).slice(-2);

    var dateUltimo =
    ultimoDia.getFullYear() + "-" +
    ("00" + (ultimoDia.getMonth() + 1)).slice(-2) + "-" +
    ("00" + ultimoDia.getDate()).slice(-2);


    document.getElementById('fechaDesde').value=datePrimer;
    document.getElementById('fechaHasta').value=dateUltimo;
    

    /**
   * Buscar Lista Pedidos
   */
    $(document).on("click", "#btn-buscar-list-pedidos",function(){
      cargarListaPedidosRevision();
      $("#modal-buscarRevisionPedido").modal("show");
    });

    $(document).on("click", "#btn-cancelar-modal-pedido",function(){
        $("#modal-buscarRevisionPedido").modal("hide");
    });


    function cargarListaPedidosRevision(){
        $.ajax({
            type: 'GET',
            url: $('#form-revision-lista-pedidos').attr("action"),
            // data: {
            //     opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
            //     cod_prod: dat_busq
            // },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
                // $('#load-grb').removeClass('d-none');
                // $('#btn-grb-empresa-form').addClass('d-none');
            },
            success: function (response) {
              //console.log(response);
    
                // if (response === 0) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Alerta!',
                //         text: 'No Exite Registro!'
                //         //footer: '<a href>Why do I have this issue?</a>'
                //     });
                // } else {
    
               table_lista_ordenes.replaceData(response.data);
                //     tab_producto = new FancyGrid.get('tb-producto-modal');
                //     tab_producto.setData(response);
                //     tab_producto.update();
                //     tab_producto.show();
                // }
    
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
                // $('#load-grb').addClass('d-none');
                // $('#btn-grb-empresa-form').removeClass('d-none');
            }
        });
    }


    /**
     * Busquedad Personalizada
     */
    $(document).on("click", "#btn-buscar-filtro-orden",function(){
        cargarListaPedidosRevisionParametros();
        $("#modal-buscarRevisionPedido").modal("show");
    });


    function cargarListaPedidosRevisionParametros(){
        let $estadoOrden = $('#orderStatus').val();
        let $fechaDesde = $('#fechaDesde').val();
        let $fechaHasta = $('#fechaHasta').val();
        $.ajax({
            type: 'POST',
            url: $('#form-filtrar-buscar-orden').attr("action"),
             data: {
            //     opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
                _token: $('#token_filtar_busqd').val(),
                estadoOrden:  $estadoOrden == '' ? 0 : $estadoOrden,
                fechaDesde : $fechaDesde,
                fechaHasta  : $fechaHasta 
            },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
                // $('#load-grb').removeClass('d-none');
                // $('#btn-grb-empresa-form').addClass('d-none');
            },
            success: function (response) {
              //console.log(response);
    
                // if (response === 0) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Alerta!',
                //         text: 'No Exite Registro!'
                //         //footer: '<a href>Why do I have this issue?</a>'
                //     });
                // } else {
    
               table_lista_ordenes.replaceData(response.data);
                //     tab_producto = new FancyGrid.get('tb-producto-modal');
                //     tab_producto.setData(response);
                //     tab_producto.update();
                //     tab_producto.show();
                // }
    
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
                // $('#load-grb').addClass('d-none');
                // $('#btn-grb-empresa-form').removeClass('d-none');
            }
        });
    }


    /**
     * 
     * @param {*} cell 
     * @param {*} formatterParams 
     * @param {*} onRendered 
     */
    var selectOrderIcon = function(cell, formatterParams, onRendered){ //plain text value
        return "<i class='fas fa-check'></i>";
    };

    table_lista_ordenes = new Tabulator("#table-reviosion-list-ordenes", {
        
        //layout:"fitColumns",
        //ajaxURL: '',
        //ajaxProgressiveLoad:"scroll",
      // paginationSize:6,
        height:"211px",
        placeholder:"No hay Datos",
        ajaxProgressiveLoad:"scroll",
                paginationSize:20,
        //pagination:"remote",
        //paginationSizeSelector:[3, 6, 8, 10],
        //movableColumns:true,
        columns:[
          {formatter:selectOrderIcon, width:40, hozAlign:"center", 
                        cellClick:function(e, cell){
                                    //alert("Printing row data for: " + cell.getRow().getData().name)
                                   //console.log(cell.getRow().getData());
                                 
                                    // $("#textbuscarPedido").attr("id_orden",cell.getRow().getData().id);
                                    // $('#textbuscarPedido').val(cell.getRow().getData().id);
                                    // $('#txt_id_cab_orden').val(cell.getRow().getData().id);
                                    // $("#textbuscarcliente").val(cell.getRow().getData().nombre_cliente);
                                    // $("#textbuscarcliente").attr("codigocliente",cell.getRow().getData().client_id);
                                    // $("#textidentification").val(cell.getRow().getData().identification);
                                    // $("#textEmail").val(cell.getRow().getData().email_cliente);
                                    // $("#textphone1").val(cell.getRow().getData().phone1);
                                    // $("#textphone2").val(cell.getRow().getData().phone2);
                                    // $("#colaborador").val(cell.getRow().getData().nombre_usuario);
                                    // $("#fechaActual").val(cell.getRow().getData().delivery_date);
                                    // $("#horaActual").val(cell.getRow().getData().delivery_time);
                                    // $("#textaddressdelivery").val(cell.getRow().getData().delivery_address);
                                    // $("#textObservacion").val(cell.getRow().getData().observation);
                                    // $('#sectors').val(cell.getRow().getData().sector_cod).change();
                                    // $('#city').val(cell.getRow().getData().city_sale_cod).change();
                                    // $('#orderStatus').val(cell.getRow().getData().order_status_cod).change().prop('disabled', false);
                                    // //$('#orderStatus').prop('disabled', false);
                                    // $("#txtTotalOrden").val(cell.getRow().getData().total_order);
                                    // $("#txt_totalComision").val(cell.getRow().getData().total_comission);
                                    // $("#modal-buscarPedido").modal("hide");
                                    // const id_order_cab = cell.getRow().getData().id;
                                    // cargarDetallePedido(id_order_cab);
    
                                }},
            {title:"N# Pedido", field:"id",hozAlign:"center",headerFilter:"input",headerFilterPlaceholder:"N# Pedido"},
            {title:"Nombre Clientes", field:"nombre_cliente",headerFilter:"input",headerFilterPlaceholder:"Cliente"},
            {title:"Identicacion", field:"identification",hozAlign:"center",headerFilter:"input",headerFilterPlaceholder:"Identificacion"},
            {title:"Fecha Orden", field:"delivery_date" },
            {title:"Hora", field:"delivery_time"},
            {title:"Direccion", field:"delivery_address"},//
            {title:"Total Orden", field:"total_order"},//
            {title:"Total Comision", field:"total_comission"},//
            {title:"Observacion", field:"observation"},//
            {title:"status_comission", field:"status_comission"},///
            {title:"Cod Sector", field:"sector_cod"},//
            {title:"Cod Ciudad", field:"city_sale_cod"},//
            {title:"Id CLiente", field:"client_id"},//
            {title:"Id Colaborador", field:"collaborator_id"},//
            {title:"Cod orden Estado", field:"order_status_cod"},//
            {title:"Nombre del Sector", field:"nombre_sector"},
            {title:"Nombre de Ciudad", field:"nombre_ciudad"},
            {title:"Nombre Estado Orden", field:"nombre_estado_ord"},
            {title:"Nombre Colaborador", field:"nombre_colaborador"},
            // {//create column group
            //   title: "ID",
            //   columns: [
            //     {title:"Cod Sector", field:"sector_cod"},//
            //     {title:"Cod Ciudad", field:"city_sale_cod"},//
            //     {title:"Id CLiente", field:"client_id"},//
            //     {title:"Id Colaborador", field:"collaborator_id"}//
                  
            //   ]
            // },
          ],
    });



});