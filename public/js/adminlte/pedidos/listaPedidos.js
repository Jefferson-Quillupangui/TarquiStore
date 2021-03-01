$(document).ready(function () {

    let table_lista_ordenes;
    let table_list_detalle_factura;
    let table_auditoria_orden;

   

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
                                     $('#txtEstadoOrden').val(cell.getRow().getData().nombre_estado_ord);
                                     $('#txt_id_cab_orden').val(cell.getRow().getData().id);
                                     $("#txtCliente").val(cell.getRow().getData().nombre_cliente);
                                     $("#txtCliente").attr("codigocliente",cell.getRow().getData().client_id);
                                     $("#txtIdentificacion").val(cell.getRow().getData().identification);
                                     $("#txtEmail").val(cell.getRow().getData().email_cliente);
                                     $("#txtPhone1").val(cell.getRow().getData().phone1);
                                     $("#txtPhone2").val(cell.getRow().getData().phone2);
                                     $("#colaborador").val(cell.getRow().getData().nombre_usuario);
                                     $("#fechaActual").val(cell.getRow().getData().delivery_date);
                                     $("#horaActual").val(cell.getRow().getData().delivery_time);
                                     $("#txtDireccion").val(cell.getRow().getData().delivery_address);
                                     $("#txtObservacion").val(cell.getRow().getData().observation);
                                     $('#txtSector').val(cell.getRow().getData().nombre_sector);
                                     $('#txtCiudad').val(cell.getRow().getData().nombre_ciudad);
                                    //  $('#txtSector').val(cell.getRow().getData().sector_cod);
                                    //  $('#txtCiudad').val(cell.getRow().getData().city_sale_cod);
                                    // $('#orderStatus').val(cell.getRow().getData().order_status_cod).change().prop('disabled', false);
                                    // //$('#orderStatus').prop('disabled', false);
                                     $("#txtTotalOrden").val("$ "+cell.getRow().getData().total_order);
                                     $("#txtTotalComision").val("$ "+cell.getRow().getData().total_comission);
                                      const id_order_cab = cell.getRow().getData().id;
                                      cargarDetalleOrden(id_order_cab);
                                      document.getElementById('generar-pdf-orden').disabled=false;
                                     $("#modal-buscarRevisionPedido").modal("hide");
                                    
    
                                }},
            {title:"Id CLiente", field:"client_id",visible:false},//
            {title:"Id Colaborador", field:"collaborator_id",visible:false},//
            {title:"Cod orden Estado", field:"order_status_cod",visible:false},//
            {title:"status_comission", field:"status_comission",visible:false},///
            {title:"Cod Sector", field:"sector_cod",visible:false},//
            {title:"N# Pedido", field:"id",hozAlign:"center",headerFilter:"input",headerFilterPlaceholder:"N# Pedido"},
            {title:"Nombre Clientes", field:"nombre_cliente",headerFilter:"input",headerFilterPlaceholder:"Cliente"},
            {title:"Identicacion", field:"identification",hozAlign:"center",headerFilter:"input",headerFilterPlaceholder:"Identificacion"},
            {title:"Fecha Orden", field:"delivery_date" },
            {title:"Hora", field:"delivery_time"},
            {title:"Direccion", field:"delivery_address"},//
            {title:"Total Orden", field:"total_order",formatter:"money", hozAlign:"right",formatterParams:{
              decimal:".",
              thousand:".",
              symbol:"$",
              symbolAfter:false,
              precision:2,
            }},//
            {title:"Total Comision", field:"total_comission",formatter:"money", hozAlign:"right",formatterParams:{
              decimal:".",
              thousand:".",
              symbol:"$",
              symbolAfter:false,
              precision:2,
            }},//
            {title:"Observacion", field:"observation"},//
            {title:"Cod Ciudad", field:"city_sale_cod"},//
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


    /**
   * CArgar el detalle del pedido
   */
  function cargarDetalleOrden(v_id_orden){
    $.ajax({
        type: 'GET',
        url: $('#form-detalle-lista-pedidos').attr("action"),
        data: {
            id_orden: v_id_orden
        },
        // dataType: "dataType",
        beforeSend: function () {
            $('.loaders').removeClass('d-none');
           
        },
        success: function (response) {

            table_list_detalle_factura.replaceData(response.data);
            cargarAuditoriaOrden(v_id_orden);
          //console.log(response);

        }, complete: function () {
            $('.loaders').addClass('d-none');
        }
    });
  }


  /**
   * Cargar los movimientos de la orden
   * @param {*} v_id_orden 
   */
  function cargarAuditoriaOrden(v_id_orden){
    $.ajax({
        type: 'GET',
        url: $('#form-auditoria-orden').attr("action"),
        data: {
            id_orden: v_id_orden
        },
        // dataType: "dataType",
        beforeSend: function () {
            $('.loaders').removeClass('d-none');
           
        },
        success: function (response) {

          table_auditoria_orden.replaceData(response.data);
            
          //console.log(response);

        }, complete: function () {
            $('.loaders').addClass('d-none');
        }
    });
  }


   /**
   * Tabla detalle para ingreso fde pedidos
   */

  table_list_detalle_factura = new Tabulator("#grid-table-list-detalle-pedido", {
      
    //layout:"fitColumns",
    //ajaxURL: '',
    //ajaxProgressiveLoad:"scroll",
   // paginationSize:6,
    height:"311px",
    placeholder:"No hay Datos",
   // data: tabledata,
    //pagination:"remote",
    //paginationSizeSelector:[3, 6, 8, 10],
    //movableColumns:true,
    columns:[
      
      
        {title:"ID DET", field:"id_detalle_product", sorter:"number",visible:false},
        {title:"CODIGO", field:"product_id", sorter:"number", width:100,  hozAlign:"center"},
        // {title:"id_product", field:"id_product", sorter:"string"},
        {title:"NOMBRE PRODUCTO", field:"name_product", sorter:"string"},
        {title:"CANTIDAD", field:"quantity", sorter:"number",hozAlign:"center"},
        //{title:"PVP UNITARIO", field:"price", sorter:"number", hozAlign:"right", width:120},
        {title:"PVP UNITARIO", field:"price", formatter:"money", hozAlign:"right", width:120, formatterParams:{
          decimal:".",
          thousand:".",
          symbol:"$",
          symbolAfter:false,
          precision:2,
        }},
        {title:"% DESCT", field:"discount_porcentage", formatter:"money",  hozAlign:"right",width:100, formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"%",
                symbolAfter:"p",
                precision:false,
            }
        },
        {title:"DESCUENTO", field:"price_discount",  formatter:"money", hozAlign:"right", width:100,formatterParams:{
              decimal:".",
              thousand:".",
              symbol:"$",
              symbolAfter:false,
              precision:2,
          }
        },
        {title:"COMISION", field:"comission",  formatter:"money", hozAlign:"right", width:100, formatterParams:{
              decimal:".",
              thousand:".",
              symbol:"$",
              symbolAfter:false,
              precision:2,
          }
        },
        {title:"TOTAL COMISION", field:"total_comission",  formatter:"money", hozAlign:"right", width:100, formatterParams:{
          decimal:".",
          thousand:".",
          symbol:"$",
          symbolAfter:false,
          precision:2,
          }
        },
        {title:"TOTAL", field:"total_line", formatter:"money",  hozAlign:"right",width:100, formatterParams:{
              decimal:".",
              thousand:".",
              symbol:"$",
              symbolAfter:false,
              precision:2,
          }
        // ,mutator:function(value, data) {
        //   return 12;//console.log(data)//Math.floor(data.views / data.users);
        //  } 
        },


        // {formatter:editIcon, width:40, hozAlign:"center", 
        //     cellClick:function(e, cell){
        //        // $("#inp_id_establecimiento").val(cell.getRow().getData().id_establecimientos);
        //        //  $("#inp_id_empresa").val(cell.getRow().getData().id_empresa);
        //        //  $("#inp_num_establecimiento").val(cell.getRow().getData().num_establecimiento);
        //        //  $("#inp_nombre_estb").val(cell.getRow().getData().nombre_estb);
        //        //  $("#inp_direccion_estb").val(cell.getRow().getData().direccion_estb);
        //        //  $('#select_estado').val(cell.getRow().getData().estado).change();
               
        //        //  $("#modal-establecimiento").modal("show");
        //         //console.log(cell.getRow().getData());
        //         //alert("Printing row data for: " + cell.getRow().getData().name)
        //     }
        // },
       ]
      //  ,rowClick: function(e, row) {
      //   alert("Row " + row.getData()+ " Clicked!!!!"); ,rowClick: function(e, row) {
      //   alert("Row " + row.getData()+ " Clicked!!!!");
    //},
    });



    var iconAudito = function(cell, formatterParams, onRendered){ //plain text value
      return "<i class='fas fa-angle-right'></i>";
  };

    table_auditoria_orden = new Tabulator("#grid-table-auditoria-estados", {
        
      //layout:"fitColumns",
      //ajaxURL: '',
   
    // paginationSize:6,
      height:"211px",
     // layout:"fitColumns",
      placeholder:"No hay Datos",
     // ajaxProgressiveLoad:"scroll",
    
      //pagination:"remote",
      //paginationSizeSelector:[3, 6, 8, 10],
      //movableColumns:true,
      columns:[
          {formatter:iconAudito, width:40, hozAlign:"center"},
          {title:"N# Pedido",  width:246,field:"order_id",hozAlign:"center"},
          {title:"Nombre Usuario", width:246, field:"nombre_usuario",},
          {title:"Estado",  width:246,field:"nombre_estado",hozAlign:"center"},
          {title:"Fecha Movimiento", width:246, field:"created_at", formatter:"html" },
         // {title:"Hora", field:"delivery_time",visible:false},
        ],
  });


});