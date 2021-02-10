
$(document).ready(function () {


  var table_detalle_factura;
  var table_lista_ordenes;



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

  /**
   * Guardar el contenido del formulario de pedidos
   */
    $(document).on("click", "#btn-generarorden",function(){
        $('.loaders').removeClass('d-none');

        // var tableDetalleProducto = new Tabulator("#grid-table-detalle-pedido");
        var tb_det_prodct = table_detalle_factura.getData();

        if(tb_det_prodct.length == 0){
          $('.loaders').addClass('d-none');
            
            $.toast({
              heading: 'Error',
              text: 'Debe agregar productos',
              showHideTransition: 'fade',
              icon: 'error',
              position: 'top-center',
          })
          
         return false;
       }
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
                observation : $('#textObservacion').val()==="" ? "-" : $('#textObservacion').val(),
                // status_comission : $('#').val(),
                // order_status_cod  : $('#').val(),
                total_order : $('#txtTotalOrden').val(),
                total_comission :  $('#txt_totalComision').val(),
                detalleProductos : JSON.stringify(tb_det_prodct),
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
                                $("#textphone1").val(cell.getRow().getData().phone1);
                                $("#textphone2").val(cell.getRow().getData().phone2);
                                $("#textEmail").val(cell.getRow().getData().email);
                                
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
  
  /**
   * Tabla detalle para ingreso fde pedidos
   */
  table_detalle_factura = new Tabulator("#grid-table-detalle-pedido", {
      
      
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
              if(confirm('Desea borrar producto')){
                  cell.getRow().delete();
                  const uno = table_detalle_factura.getData();
                  
                    var total = 0;
                    for (var i in uno) {
                      total += parseFloat(uno[i].total_line)
                    }

                  $("#txtTotalOrden").val(total);

                  }
              }
          },
          {title:"ID_PROCT", field:"product_id", sorter:"number", width:80},
          // {title:"id_product", field:"id_product", sorter:"string"},
          {title:"NOMBRE PRODUCTO", field:"name_product", sorter:"string"},
          {title:"CANTIDAD", field:"quantity", sorter:"number", hozAlign:"center",editor:"input",
          cellEdited :function(cell){

            let rpt_func_stock= 0;
            consultarStockProducto(cell.getData().product_id)
            .then(function(datosDevueltos){// Aquí el código para hacer algo con datosDevueltos
              rpt_func_stock = datosDevueltos;
              console.log(rpt_func_stock);
            }, function(errorLanzado){// Aquí el código para hacer algo cuando ocurra un error.
              console.log(errorLanzado);
            });
              //console.log(cell.getData());
              
           let id_cell = cell.getData().product_id;
           let v_cantidad =  cell.getData().quantity;
           parseInt(v_cantidad);
           let v_precio_unitario =  cell.getData().price;
           parseFloat(v_precio_unitario);

           let v_comission = cell.getData().comission;

           var v_final_total = parseInt(v_cantidad)*parseFloat(v_precio_unitario) ;
           var v_total_comission = parseInt(v_cantidad)*parseFloat(v_comission) ;
           //parseFloat(v_precio_unitario) = parseInt(v_cantidad)*parseFloat(v_precio_unitario);


        //console.log(v_final_total);

           const uno = table_detalle_factura.getData();

           var data_oj_detalle = [];
          
           //var nuevo = uno.shift();
           
          for (var i in uno) {
              if(uno[i].product_id === id_cell ){
                    uno[i].total_line = v_final_total;
                    uno[i].total_comission = v_total_comission;
                     data_oj_detalle.push(uno[i]);
                     //console.log(uno[i]);
              }else{
                //console.log(uno[i]);
                data_oj_detalle.push(uno[i]);
              }
               
                
            }
          table_detalle_factura.clearData();
          table_detalle_factura.updateOrAddData(data_oj_detalle);

          var total_prod = 0;
          var total_comis = 0;
          for (var i in uno) {
            
            total_prod += parseFloat(uno[i].total_line);
            total_comis += parseFloat(uno[i].total_comission);

           
              
          }

          $("#txtTotalOrden").val(total_prod);
          $("#txt_totalComision").val(total_comis);
          
          


          //  // console.log(cell.getData());
          //      let v_cantidad =  cell.getData().quantity;
          //      parseInt(v_cantidad);
          //      let v_precio_unitario =  cell.getData().price;
          //      parseFloat(v_precio_unitario);




          //      const uno = table_detalle_factura.getData();
              
          //      var nuevo = uno.shift();
          //       console.log(nuevo);


              //  table_detalle_factura.updateData([{discount_porcentage: 0,
              //   name_product: "Cacerola Betty Crocker 24 cm",
              //   price: "39.99",
              //   price_discount: "0.00",
              //   product_id: 4,
              //   quantity: "3",
              //   total_line: 0,}]);

               //table_detalle_factura.updateOrAddData(cell.getData());
               //table_detalle_factura.update();

               //console.log(cell.getData().total_line);
              // cell.getData().total_line= 2;
              // console.log(parseInt(v_cantidad)*parseFloat(v_precio_unitario));
              // table_detalle_factura[0].total_line = parseInt(v_cantidad)*parseFloat(v_precio_unitario);
               //$("#grid-table-detalle-pedido").Tabulator("updateData", [{id:1, "total_line":"25"}], false);
               

                //update columns and data without destroying the table
                                // $("#grid-table-detalle-pedido").tabulator("setColumns", res["column"]);
                                // $("#grid-table-detalle-pedido").tabulator("setData", res["data"]);
              // table_detalle_factura.addData([{id_rgt_det:0, subtotal_prod: parseInt(v_cantidad)*parseFloat(v_precio_unitario)}]);
          
              // table_detalle_factura.updateOrAddData();


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
          {title:"PVP UNITARIO", field:"price", sorter:"number", hozAlign:"right", width:120},
          {title:"% DESCT", field:"discount_porcentage", sorter:"number",  hozAlign:"right",width:100},
          {title:"DESCUENTO", field:"price_discount", sorter:"number", hozAlign:"right", width:100},
          {title:"COMISION", field:"comission", sorter:"number", hozAlign:"right", width:100},
          {title:"TOTAL COMISION", field:"total_comission", sorter:"number", hozAlign:"right", width:100},
          {title:"TOTAL", field:"total_line", sorter:"number",  hozAlign:"right",width:100
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
                                const obj = cell.getRow().getData();

                                //update columns and data without destroying the table
                                // $("#grid-table-detalle-pedido").tabulator("setColumns", res["column"]);
                                // $("#grid-table-detalle-pedido").tabulator("setData", res["data"]);
                                //var tablaliquidacion = FancyGrid.get('detalles_liquidacion_produccion');

                                table_detalle_factura.updateOrAddData([
                                  {
                                    product_id : obj.id,
                                    name_product : obj.name,
                                    quantity : 0,//obj.quantity,
                                    price :  obj.price,
                                    discount_porcentage : obj.discount,
                                    price_discount : obj.price_discount,
                                    comission : obj.comission,
                                    total_comission : obj.comission,
                                    total_line : 0,
                                      // id_rgt_det: 0, 
                                      // id_product:o.item.data.id_product,
                                      // cod_prod: o.item.data.cod_prod,
                                      // cantidad: 0,
                                      // precio_unitario: o.item.data.precio_unitario,
                                      // subtotal_prod: 0,
                                      // desct_prod_porcent: 0,
                                      // desct_prod_valor: 0,
                                      // total_prod: 0
                                  }
                              ]);

                              $("#modal-buscarProducto").modal("hide");

                                // $("#textidentification").val(cell.getRow().getData().identification);
                                // $("#textbuscarcliente").val(cell.getRow().getData().name);
                                // $("#textaddressdelivery").val(cell.getRow().getData().address);
                                // $("#textbuscarcliente").attr("codigocliente", cell.getRow().getData().id);
                            
                            }},
      {title:"Id", field:"id"},
      {title:"Nombre Producto", field:"name", width:200,headerFilter:"input"},
      {title:"Precio", field:"price", sorter:"number"},
      {title:"Comision", field:"comission"},
      {title:"Cantidad", field:"quantity"},
      {title:"% DESCT", field:"discount"},
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
          //console.log(response);

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

  /**
   * Buscar pedidos
   */
  $(document).on("click", "#btn-buscar-pedido",function(){

      cargarListaPedidos();
      $("#modal-buscarPedido").modal("show");
  });

  $(document).on("click", "#btn-cancelar-modal-pedido",function(){
    $("#modal-buscarPedido").modal("hide");
  });
 

  function cargarListaPedidos(){
    $.ajax({
        type: 'GET',
        url: $('#form-lista-pedidos').attr("action"),
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
         // console.log(response);

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
   * CArgar el detalle del pedido
   */
  function cargarDetallePedido(v_id_orden){
    $.ajax({
        type: 'GET',
        url: $('#form-detalle-pedidos').attr("action"),
        data: {
            //opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
            id_orden: v_id_orden
        },
        // dataType: "dataType",
        beforeSend: function () {
            $('.loaders').removeClass('d-none');
            // $('#load-grb').removeClass('d-none');
            // $('#btn-grb-empresa-form').addClass('d-none');
        },
        success: function (response) {

          table_detalle_factura.replaceData(response.data);
          //console.log(response);

            // if (response === 0) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Alerta!',
            //         text: 'No Exite Registro!'
            //         //footer: '<a href>Why do I have this issue?</a>'
            //     });
            // } else {

         /////  table_lista_ordenes.replaceData(response.data);
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
   * consultar el stock del producto
   * @param {*} cell 
   * @param {*} formatterParams 
   * @param {*} onRendered 
   */
  function consultarStockProducto (v_id_product){
    // La primera diferencia es que no se le pasa un callback,
    // La función devuelve una Promise
    return new Promise(function(resolver, rechazar){
      jQuery.ajax({
        type: 'GET',
        url:$('#form-stock-productos').attr("action"),
        data: {
          id_producto: v_id_product
        },
        success : function(response){
          resolver(response.data[0].quantity);
        },
        error : function(error){rechazar(error)}
      });
    });
  }
  // function consultarStockProducto(v_id_product){
    
  //     var $valor=0;
  //     $.ajax({
  //         type: 'GET',
  //         url: $('#form-stock-productos').attr("action"),
  //         data: {
  //             //opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
  //             id_producto: v_id_product
  //         },
  //         // dataType: "dataType",
  //         beforeSend: function () {
  //             $('.loaders').removeClass('d-none');
  //         }, success: function (response) {
  //          $valor = response.data[0].quantity;
  //         }, complete: function () {
  //             $('.loaders').addClass('d-none');
  //         }
  //   });
  // }

  var selectOrderIcon = function(cell, formatterParams, onRendered){ //plain text value
      return "<i class='fas fa-check'></i>";
  };

  table_lista_ordenes = new Tabulator("#table-lista-ordenes", {
        
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
                                // // $("#textidentification").val(cell.getRow().getData().identification);
                                // // $("#textbuscarcliente").val(cell.getRow().getData().name);
                                // // $("#textaddressdelivery").val(cell.getRow().getData().address);
                                // // $("#textbuscarcliente").attr("codigocliente", cell.getRow().getData().id);
                                // // $("#textphone1").val(cell.getRow().getData().phone1);
                                // // $("#textphone2").val(cell.getRow().getData().phone2);
                                // // $("#textEmail").val(cell.getRow().getData().email);
                                $('#textbuscarPedido').val(cell.getRow().getData().id);
                                $("#textbuscarcliente").val(cell.getRow().getData().nombre_cliente);
                                $("#textbuscarcliente").attr("codigocliente",cell.getRow().getData().client_id);
                                $("#textidentification").val(cell.getRow().getData().identification);
                                $("#textEmail").val(cell.getRow().getData().email_cliente);
                                $("#textphone1").val(cell.getRow().getData().phone1);
                                $("#textphone2").val(cell.getRow().getData().phone2);
                                $("#colaborador").val(cell.getRow().getData().nombre_usuario);
                                $("#fechaActual").val(cell.getRow().getData().delivery_date);
                                $("#horaActual").val(cell.getRow().getData().delivery_time);
                                $("#textaddressdelivery").val(cell.getRow().getData().delivery_address);
                                $("#textObservacion").val(cell.getRow().getData().observation);
                                $('#sectors').val(cell.getRow().getData().sector_cod).change();
                                $('#city').val(cell.getRow().getData().city_sale_cod).change();
                                $('#orderStatus').val(cell.getRow().getData().order_status_cod).change();
                                $("#txtTotalOrden").val(cell.getRow().getData().total_order);
                                $("#txt_totalComision").val(cell.getRow().getData().total_comission);
                                $("#modal-buscarPedido").modal("hide");
                                const id_order_cab = cell.getRow().getData().id;
                                cargarDetallePedido(id_order_cab);

                            }},
      {title:"Id", field:"id",headerFilter:"input"},
      {title:"Fecha Orden", field:"delivery_date"},
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
      {title:"Identicacion", field:"identification"},
      {title:"Nombre Colaborador", field:"nombre_colaborador"}
      //{title:"Date Of Birth", field:"dob", hozAlign:"center"},
      ],
  });


});