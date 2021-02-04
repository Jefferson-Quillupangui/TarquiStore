
$(document).ready(function () {

  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10

    currentHours = fecha.getHours();
    currentHours = ("0" + currentHours).slice(-2);

     currentMin = fecha.getMinutes();
     currentMin = ("0" + currentMin).slice(-2);
    var hora = currentHours + ':' + currentMin;
    var fecha = ano+"-"+mes+"-"+dia ;
    
  document.getElementById('fechaActual').value=fecha;
  document.getElementById('horaActual').value=hora;

    $(document).on("click", "#btn-generarorden",function(){
        $('.loaders').removeClass('d-none');
        $.ajax(
            {
              url : $('#form-crearorden').attr("action"),
              type: "POST",
              data : {
                _token: $('#token').val(),
                client_id  :  $('#textbuscarcliente').attr("codigocliente"),
                delivery_date  : $('#fechaActual').val(),
                delivery_time : $('#horaActual').val(),
                collaborator_id  : $('#colaborador').attr('id_colaborador'),
                sector_cod  : $('#sectors').val(),
                city_sale_cod  : $('#city').val(),
                delivery_address : $('#textaddressdelivery').val(),
                observation : $('#textObservacion').val(),
                // status_comission : $('#').val(),
                // order_status_cod  : $('#').val(),
                total_order : $('#txtTotalOrden').val(),
                total_comission :  $('#txt_totalComision').val(),
                // opcion: 'AA', 
                // clienteid: $('#textbuscarcliente').attr("codigocliente"),
                // totalord: 22,
                // addresdelivery:  $('#textaddressdelivery').val(),
              }
            }).done(function(dt) {
                
                if(dt.data.out_cod === 7){
                    $('.loaders').addClass('d-none');
                    Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: dt.data.out_msj+" Nro Orden: 000"+dt.data.out_id_order.id,
                         showConfirmButton: false,
                         timer: 1500
                        });
                        window.location.reload(); // Recargar página
                }else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: 'Error 07 al crear orden'
                            })
                }
            }).fail(function(data) {
                console.log(data);    
                //alert( "error" );
                $('.loaders').addClass('d-none');
                if(data.status===500){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al crear orden'
                  })}
            }).always(function(data) {
                $('.loaders').addClass('d-none');
                //console.log(data);    
                //alert( "complete" );
            });

       
       

    }); 

    $(document).on("click", "#btn-buscarpersona",function(){
      
     // $('.loaders').removeClass('d-none');
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
                {title:"ID", field:"id", sorter:"string", width:0, headerFilter:"input",visible:false},
                {title:"Identificación", field:"identification", sorter:"string", width:130, headerFilter:"input"},
                {title:"Nombre", field:"name", sorter:"string", width:200, headerFilter:"input"},
                {title:"Apellidos", field:"last_name", sorter:"string", width:200, headerFilter:"input"},
                {title:"Dirección", field:"address", sorter:"string", width:200, headerFilter:"input" },
                {title:"Telefono1", field:"phone1", sorter:"string", width:200, headerFilter:"input"},
                {title:"Telefono2", field:"phone2", sorter:"string", width:200, headerFilter:"input"},
                {title:"Email", field:"email", sorter:"string", width:200, headerFilter:"input"},
                {title:"Tipo de documento", field:"name_document", sorter:"string", width:200, headerFilter:"input"},
              
              
            ],
        });

        
        
    }

    /**
     * tabla detalle pedido
     */
    var printIconDelete = function(cell, formatterParams, onRendered){ //plain text value
      return "<i class='fa fa-trash fa-lg'></i>";
  };
  
  var table_detalle_factura = new Tabulator("#grid-table-detalle-pedido", {
      
      
      //layout:"fitColumns",
      //ajaxURL: '',
      //ajaxProgressiveLoad:"scroll",
     // paginationSize:6,
      height:"311px",
      placeholder:"No hay Datos",
      //pagination:"remote",
      //paginationSizeSelector:[3, 6, 8, 10],
      //movableColumns:true,
      columns:[

         // : 0,
                              //     : o.item.data.id_product,
                              //     : o.item.data.cod_prod,
                              //     cantidad: 0,
                              //     : o.item.data.precio_unitario,
                              //     : 0,
                              //     : 0,
                              //     : 0,
                              //     : 0
          {formatter:printIconDelete, width:40, hozAlign:"center", cellClick:function(e, cell){
              if(confirm('Are you sure you want to delete this entry?')){
                  cell.getRow().delete();
                  }
              }
          },
          {title:"id_rgt_det", field:"id_rgt_det", sorter:"number", width:80},
          {title:"id_product", field:"id_product", sorter:"string"},
          {title:"cod_prod", field:"cod_prod", sorter:"string"},
          {title:"CANTIDAD", field:"cantidad", sorter:"number", hozAlign:"center",editor:"input",
          cellEdited :function(cell){
              let v_cantidad =  cell.getData().cantidad;
              parseInt(v_cantidad);
              let v_precio_unitario =  cell.getData().precio_unitario;
              parseFloat(v_precio_unitario);
              console.log(parseInt(v_cantidad)*parseFloat(v_precio_unitario));
              table_detalle_factura.addData([{id_rgt_det:0, subtotal_prod: parseInt(v_cantidad)*parseFloat(v_precio_unitario)}]);
          
              table_detalle_factura.updateOrAddData();
              // // const momentoComida = uno.map(function(comida) {
              // //     table_detalle_factura.updateOrAddData([
              // //             {
              // //                 id_rgt_det: comida.id_rgt_det, 
              // //                 id_product:comida.id_product,
              // //                 cod_prod: comida.cod_prod,
              // //                 cantidad: comida.cantidad,
              // //                 precio_unitario: comida.precio_unitario,
              // //                 subtotal_prod: comida.subtotal_prod,
              // //                 desct_prod_porcent: comida.desct_prod_porcent,
              // //                 desct_prod_valor: comida.desct_prod_valor,
              // //                 total_prod: comida.total_prod
              // //             }
              // //         ])
              // //     //return comida;
               
              // // });
          
          }},
          {title:"PVP UNITARIO", field:"precio_unitario", sorter:"number", hozAlign:"right", width:120},
          {title:"subtotal_prod", field:"subtotal_prod", sorter:"number",  hozAlign:"right",width:100},
          {title:"desct_prod_porcent", field:"desct_prod_porcent", sorter:"number", hozAlign:"right", width:100},
          {title:"desct_prod_valor", field:"desct_prod_valor", sorter:"number",  hozAlign:"right",width:100},
          {title:"total_prod", field:"total_prod", sorter:"number",  hozAlign:"right",width:100},
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
         ],
  });
   


  /**
   * Prodcutos modal
   */

  var printIconProduct = function(cell, formatterParams, onRendered){ //plain text value
    return "<i class='fas fa-check'></i>";
};

  var table_detalle_producto = new Tabulator("#producto-table", {
        
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
      {formatter:printIconProduct, width:40, hozAlign:"center", 
                    cellClick:function(e, cell){
                                //alert("Printing row data for: " + cell.getRow().getData().name)
                               // console.log(cell.getRow().getData());
                                // $("#textidentification").val(cell.getRow().getData().identification);
                                // $("#textbuscarcliente").val(cell.getRow().getData().name);
                                // $("#textaddressdelivery").val(cell.getRow().getData().address);
                                // $("#textbuscarcliente").attr("codigocliente", cell.getRow().getData().id);
                                $("#modal-buscarProducto").modal("hide");
                            }},
      {title:"Id", field:"id"},
      {title:"Name", field:"name", width:290},
      {title:"Precio", field:"price", sorter:"number"},
      {title:"Comision", field:"comission"},
      {title:"Cantidad", field:"quantity"},
      {title:"PVP DESCT", field:"price_discount"},
      //{title:"Date Of Birth", field:"dob", hozAlign:"center"},
      ],
  


    // columns:[

    //   // : 0,
    //                         //     : o.item.data.id_product,
    //                         //     : o.item.data.cod_prod,
    //                         //     cantidad: 0,
    //                         //     : o.item.data.precio_unitario,
    //                         //     : 0,
    //                         //     : 0,
    //                         //     : 0,
    //                         //     : 0
    //     {formatter:printIcon, width:40, hozAlign:"center", cellClick:function(e, cell){
    //         if(confirm('Are you sure you want to delete this entry?')){
    //             cell.getRow().delete();
    //             }
    //         }
    //     },
    //     {title:"id_rgt_det", field:"id_rgt_det", sorter:"number", width:80},
    //     {title:"id_product", field:"id_product", sorter:"string"},
    //     {title:"cod_prod", field:"cod_prod", sorter:"string"},
    //     {title:"CANTIDAD", field:"cantidad", sorter:"number", hozAlign:"center",editor:"input",
    //     cellEdited :function(cell){
    //         let v_cantidad =  cell.getData().cantidad;
    //         parseInt(v_cantidad);
    //         let v_precio_unitario =  cell.getData().precio_unitario;
    //         parseFloat(v_precio_unitario);
    //         console.log(parseInt(v_cantidad)*parseFloat(v_precio_unitario));
    //         table_detalle_factura.addData([{id_rgt_det:0, subtotal_prod: parseInt(v_cantidad)*parseFloat(v_precio_unitario)}]);
        
    //         table_detalle_factura.updateOrAddData();
    //         // // const momentoComida = uno.map(function(comida) {
    //         // //     table_detalle_factura.updateOrAddData([
    //         // //             {
    //         // //                 id_rgt_det: comida.id_rgt_det, 
    //         // //                 id_product:comida.id_product,
    //         // //                 cod_prod: comida.cod_prod,
    //         // //                 cantidad: comida.cantidad,
    //         // //                 precio_unitario: comida.precio_unitario,
    //         // //                 subtotal_prod: comida.subtotal_prod,
    //         // //                 desct_prod_porcent: comida.desct_prod_porcent,
    //         // //                 desct_prod_valor: comida.desct_prod_valor,
    //         // //                 total_prod: comida.total_prod
    //         // //             }
    //         // //         ])
    //         // //     //return comida;
            
    //         // // });
        
    //     }},
    //     {title:"PVP UNITARIO", field:"precio_unitario", sorter:"number", hozAlign:"right", width:120},
    //     {title:"subtotal_prod", field:"subtotal_prod", sorter:"number",  hozAlign:"right",width:100},
    //     {title:"desct_prod_porcent", field:"desct_prod_porcent", sorter:"number", hozAlign:"right", width:100},
    //     {title:"desct_prod_valor", field:"desct_prod_valor", sorter:"number",  hozAlign:"right",width:100},
    //     {title:"total_prod", field:"total_prod", sorter:"number",  hozAlign:"right",width:100},
    //   ],
  });

  $(document).on("click", "#btn-modal-buscar-producto",function(){

      cargarListaProductos();
      $("#modal-buscarProducto").modal("show");
  });

  $(document).on("click", "#btn-cancelar-producto",function(){
    $("#modal-buscarProducto").modal("hide");
  });


  


  function cargarListaProductos(){

    //let dat_busq = $('#inp_codigo_producto').val();
    $.ajax({
        type: 'GET',
        url: $('#form-listarproductos').attr("action"),
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
          console.log(response);

            // if (response === 0) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Alerta!',
            //         text: 'No Exite Registro!'
            //         //footer: '<a href>Why do I have this issue?</a>'
            //     });
            // } else {

              table_detalle_producto.replaceData(response.data);
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



 

});