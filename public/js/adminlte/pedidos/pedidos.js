
$(document).ready(function () {


  var table_detalle_factura;
  var table_lista_ordenes;
  var array_detalle_factura_eliminados = [];

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

  

  $('#orderStatus').val('OP').change();
    //$('#orderStatus').prop('disabled', false);

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
        
       let id_orden = $('#txt_id_cab_orden').val();

        let msj = id_orden == '0' ? 'Guardar Pedido' : 'Actualizar Pedido';

        // var tableDetalleProducto = new Tabulator("#grid-table-detalle-pedido");
        var tb_det_prodct = table_detalle_factura.getData();

      
        let id_cliente_facturar = $('#textbuscarcliente').attr("codigocliente");
      
        
        if(id_cliente_facturar == '0'){
          $('.loaders').addClass('d-none');
            
            $.toast({
              heading: 'Error',
              text: 'Debe seleccionar Cliente',
              showHideTransition: 'fade',
              icon: 'error',
              position: 'top-right',
          })
         return false;
        }else if($('#sectors').val() == 0 || $('#sectors').val() == "0" || $('#sectors').val() == ""){
          $('.loaders').addClass('d-none');
            
            $.toast({
              heading: 'Error',
              text: 'Debe seleccionar un Sector',
              showHideTransition: 'fade',
              icon: 'error',
              position: 'top-center',
          })
          
         return false;
        }else if($('#city').val() == 0 || $('#city').val() == "0" || $('#city').val() == ""){
          $('.loaders').addClass('d-none');
            
            $.toast({
              heading: 'Error',
              text: 'Debe seleccionar una Ciudad',
              showHideTransition: 'fade',
              icon: 'error',
              position: 'top-center',
          })
          
         return false;
        }else if(tb_det_prodct.length == 0){
          $('.loaders').addClass('d-none');
            
            $.toast({
              heading: 'Error',
              text: 'Debe agregar productos',
              showHideTransition: 'fade',
              icon: 'error',
              position: 'top-center',
          })
          
         return false;
       }else if( tb_det_prodct.length > 0 ){
        for (const z in tb_det_prodct) {
          //console.log(tb_det_prodct[z]);
          if(tb_det_prodct[z].quantity === 0 || tb_det_prodct[z].quantity === ''){
            $.toast({
              heading: 'Error',
              text: 'No se puede guardar la orden. Ingrese Cantidad en el producto : '+tb_det_prodct[z].name_product,
              showHideTransition: 'fade',
              icon: 'error',
              position: 'top-right',
            })
            return false;
          }
        }
       }

       
      Swal.fire({
        title: '<strong>' + msj + '</strong>',
        icon: 'info',
        html:
            'Confirmar...',
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
            '<i class="fa fa-check"></i>',
        confirmButtonAriaLabel: 'Thumbs up, great!',
        cancelButtonText:
            '<i class="fa fa-times"></i>',
        cancelButtonAriaLabel: 'Thumbs down'
      }).then((result) => {
        if (result.value === true){
          $('.loaders').removeClass('d-none');
          $.ajax(
            {
              url : $('#form-crearorden').attr("action"),
              type: "POST",
              data : {
                _token: $('#token').val(),
                opcion : id_orden=="0" ?'AA' : 'AB',
                id_pedido : id_orden,
                client_id  :  $('#textbuscarcliente').attr("codigocliente"),
                delivery_date  : $('#fechaActual').val(),
                delivery_time : $('#horaActual').val(),
                collaborator_id  : $('#colaborador').attr('id_colaborador'),
                sector_cod  : $('#sectors').val(),
                city_sale_cod  : $('#city').val(),
                delivery_address : $('#textaddressdelivery').val()==="" ? "-" : $('#textaddressdelivery').val(),
                observation : $('#textObservacion').val()==="" ? "-" : $('#textObservacion').val(),
                // status_comission : $('#').val(),
                order_status_cod  : $('#orderStatus').val(),
                total_order : $('#txtTotalOrden').val(),
                total_comission :  $('#txt_totalComision').val(),
                detalleProductos : JSON.stringify(tb_det_prodct),
                detalleProductosBorrar : JSON.stringify(array_detalle_factura_eliminados),
                // opcion: 'AA', 
                // clienteid: $('#textbuscarcliente').attr("codigocliente"),
                // totalord: 22,
                // addresdelivery:  $('#textaddressdelivery').val(),
              }
            }).done(function(dt) {
                console.log(dt);
              $('.loaders').addClass('d-none');
                if(dt.data.out_cod === 7){
                    $('.loaders').addClass('d-none');
                    Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: dt.data.out_msj+" Nro Orden: 000"+dt.data.out_id_order,
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


        }
      });
    
    }); 

    $(document).on("click", "#btn-buscarpersona",function(){
      // if( $('#textbuscarcliente').val() != ""){
      //   document.getElementById("btn-modal-buscar-producto").disabled = false
      // }else{
      //   document.getElementById("btn-modal-buscar-producto").disabled = true
      // }

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
            ajaxProgressiveLoad:"load",
            //ajaxProgressiveLoad:"scroll",
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
                {title:"Identificación", field:"identification", sorter:"string", width:130, headerFilter:"input", headerFilterPlaceholder:"Identificación"},
                {title:"Nombre", field:"name", sorter:"string", width:200, headerFilter:"input",  headerFilterPlaceholder:"Buscar Nombre"},
                {title:"Apellidos", field:"last_name", sorter:"string", width:200, headerFilter:"input",  headerFilterPlaceholder:"Buscar Apellidos"},
                {title:"Dirección", field:"address", sorter:"string", width:200, headerFilter:"input" ,  headerFilterPlaceholder:"Buscar Dirección"},
                {title:"Telefono1", field:"phone1", sorter:"string", width:200, headerFilter:"input",  headerFilterPlaceholder:"Buscar Telefono1"},
                {title:"Telefono2", field:"phone2", sorter:"string", width:200, headerFilter:"input",  headerFilterPlaceholder:"Buscar Telefono2"},
                {title:"Email", field:"email", sorter:"string", width:200, headerFilter:"input",  headerFilterPlaceholder:"Buscar Email"},
                {title:"Tipo de documento", field:"name_document", sorter:"string", width:200, headerFilter:"select", headerFilterParams:{values:true}, headerFilterPlaceholder:"Buscar documento"},//headerFilter:"input",  headerFilterPlaceholder:"Buscar Tipo de documento"},
              
              
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

  // const $product_delete=false;
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
        
          {formatter:printIconDelete, width:40, hozAlign:"center", cellClick:function(e, cell){
            
              $.confirm({
                icon: 'fa fa-exclamation-triangle',
                title: 'Desea borrar producto?',
                content: cell.getData().name_product,
                type: 'orange',
                buttons: {   
                    ok: {
                        text: "Aceptar",
                        btnClass: 'btn-warning',
                        keys: ['enter'],
                        action: function(){
                          if( cell.getData().id_detalle_product != 0){
                            array_detalle_factura_eliminados.push(cell.getData());
                            console.log(array_detalle_factura_eliminados);
                          }
                          
                          cell.getRow().delete();
                          const uno = table_detalle_factura.getData();
                          
                            var total = 0;
                            var total_comi = 0;
                            for (var i in uno) {
                              total_comi += parseFloat(uno[i].total_comission);
                              total += parseFloat(uno[i].total_line)
                            }
        
                          $("#txtTotalOrden").val(total.toFixed(2));
                          $("#txt_totalComision").val(total_comi.toFixed(2));
                        }
                    },
                    cancel:{
                      text: "Cancelar",
                      btnClass: 'btn-red',
                      function(){
                      
                        //    console.log('the user clicked cancel');
                      }
                    } 
                }
            });
              // if( confirm('Desea borrar producto')){

              //     if( cell.getData().id_detalle_product != 0){
              //       array_detalle_factura_eliminados.push(cell.getData());
              //       console.log(array_detalle_factura_eliminados);
              //     }
                  
              //     cell.getRow().delete();
              //     const uno = table_detalle_factura.getData();
                  
              //       var total = 0;
              //       var total_comi = 0;
              //       for (var i in uno) {
              //         total_comi += parseFloat(uno[i].total_comission);
              //         total += parseFloat(uno[i].total_line)
              //       }

              //     $("#txtTotalOrden").val(total.toFixed(2));
              //     $("#txt_totalComision").val(total_comi.toFixed(2));

              //     }
              }
          },
          {title:"ID DET", field:"id_detalle_product", sorter:"number", width:0,visible:false},
          {title:"ID_PROCT", field:"product_id", sorter:"number", width:80},
          // {title:"id_product", field:"id_product", sorter:"string"},
          {title:"NOMBRE PRODUCTO", field:"name_product", sorter:"string"},
          {title:"CANTIDAD", field:"quantity", sorter:"number", validator:["min:1", "max:10000", "numeric"],hozAlign:"center",editor:"input",
          cellEdited :function(cell){

           // console.log(cell.getData());
            let cantidad_product = cell.getData().quantity;
            let rpt_func_stock= 0;
            rpt_func_stock = consultarStockProducto(cell.getData().product_id);
           if( rpt_func_stock < parseInt(cantidad_product) ){
             //
              $.confirm({
                icon: 'fa fa-exclamation-triangle',
                title: 'Advertencia',
                content: 'Actualmente solo hay en stock la cantidad :'+rpt_func_stock,
                type: 'red',
                buttons: {   
                    ok: {
                        text: "Aceptar",
                        btnClass: 'btn-red',
                        keys: ['enter'],
                        // action: function(){
                        //     console.log('the user clicked confirm');
                        // }
                    },
                    // cancel: function(){
                    //         console.log('the user clicked cancel');
                    // }
                }
            });
             //alert("Actualmente solo hay en stock la cantidad : "+rpt_func_stock);
             document.getElementById('btn-modal-buscar-producto').disabled=true;
             document.getElementById('btn-generarorden').disabled=true;
             const get_data_detalle_nueva = table_detalle_factura.getData();

          //    for (var i in get_data_detalle_nueva) {
          //     if(get_data_detalle[i].product_id === id_cell ){
          //         get_data_detalle[i].total_line = v_final_total;
          //         get_data_detalle[i].total_comission = v_total_comission;
          //         data_oj_detalle.push(get_data_detalle[i]);
                     
          //     }else{
                
          //       data_oj_detalle.push(get_data_detalle[i]);
          //     }
                
                
          //   }
          // table_detalle_factura.clearData();
          // table_detalle_factura.updateOrAddData(data_oj_detalle);


             return false;
           }else{
                let id_cell = cell.getData().product_id;
                let v_cantidad =  cell.getData().quantity;
                parseInt(v_cantidad);
                let v_descuento =  cell.getData().price_discount;
                parseFloat(v_descuento);
                let v_precio_unitario =  cell.getData().price;
                parseFloat(v_precio_unitario);
    
                let v_comission = cell.getData().comission;
    
                let v_total_descuento = parseInt(v_cantidad)*parseFloat(v_descuento) ;
                var v_final_total = parseInt(v_cantidad)*parseFloat(v_precio_unitario) ;

                if(parseFloat(v_descuento) > 0){
                    let v_total_Menos_descuento =  parseFloat(v_final_total) - parseFloat(v_total_descuento);
                    v_final_total = parseFloat(v_final_total) - parseFloat(v_total_Menos_descuento);
                }else{
                  v_final_total = v_final_total;
                }
                
                
                
                var v_total_comission = parseInt(v_cantidad)*parseFloat(v_comission) ;
                //parseFloat(v_precio_unitario) = parseInt(v_cantidad)*parseFloat(v_precio_unitario);
    
    
            //console.log(v_final_total);
    
                const get_data_detalle = table_detalle_factura.getData();
    
                var data_oj_detalle = [];
              
                //var nuevo = get_data_detalle.shift();
                
              for (var i in get_data_detalle) {
                  if(get_data_detalle[i].product_id === id_cell ){
                      get_data_detalle[i].total_line = v_final_total;
                      get_data_detalle[i].total_comission = v_total_comission;
                      data_oj_detalle.push(get_data_detalle[i]);
                          //console.log(get_data_detalle[i]);
                  }else{
                    //console.log(get_data_detalle[i]);
                    data_oj_detalle.push(get_data_detalle[i]);
                  }
                    
                    
                }
              table_detalle_factura.clearData();
              table_detalle_factura.updateOrAddData(data_oj_detalle);
    
              var total_prod = 0;
              var total_comis = 0;
              for (var i in get_data_detalle) {
                
                total_prod += parseFloat(get_data_detalle[i].total_line);
                total_comis += parseFloat(get_data_detalle[i].total_comission);
      
              }
    
              $("#txtTotalOrden").val(total_prod.toFixed(2));
              $("#txt_totalComision").val(total_comis.toFixed(2));
              document.getElementById('btn-modal-buscar-producto').disabled=false;
              document.getElementById('btn-generarorden').disabled=false;
           }
            // .then(function(datosDevueltos){// Aquí el código para hacer algo con datosDevueltos
            //   rpt_func_stock = datosDevueltos;
            //   console.log(rpt_func_stock);
            // }, function(errorLanzado){// Aquí el código para hacer algo cuando ocurra un error.
            //   console.log(errorLanzado);
            // });
              //console.log(cell.getData());
              
              ///------------------------------------------------------
        // // //    let id_cell = cell.getData().product_id;
        // // //    let v_cantidad =  cell.getData().quantity;
        // // //    parseInt(v_cantidad);
        // // //    let v_precio_unitario =  cell.getData().price;
        // // //    parseFloat(v_precio_unitario);

        // // //    let v_comission = cell.getData().comission;

        // // //    var v_final_total = parseInt(v_cantidad)*parseFloat(v_precio_unitario) ;
        // // //    var v_total_comission = parseInt(v_cantidad)*parseFloat(v_comission) ;
        // // //    //parseFloat(v_precio_unitario) = parseInt(v_cantidad)*parseFloat(v_precio_unitario);


        // // // //console.log(v_final_total);

        // // //    const get_data_detalle = table_detalle_factura.getData();

        // // //    var data_oj_detalle = [];
          
        // // //    //var nuevo = get_data_detalle.shift();
           
        // // //   for (var i in get_data_detalle) {
        // // //       if(get_data_detalle[i].product_id === id_cell ){
        // // //           get_data_detalle[i].total_line = v_final_total;
        // // //           get_data_detalle[i].total_comission = v_total_comission;
        // // //           data_oj_detalle.push(get_data_detalle[i]);
        // // //              //console.log(get_data_detalle[i]);
        // // //       }else{
        // // //         //console.log(get_data_detalle[i]);
        // // //         data_oj_detalle.push(get_data_detalle[i]);
        // // //       }
               
                
        // // //     }
        // // //   table_detalle_factura.clearData();
        // // //   table_detalle_factura.updateOrAddData(data_oj_detalle);

        // // //   var total_prod = 0;
        // // //   var total_comis = 0;
        // // //   for (var i in get_data_detalle) {
            
        // // //     total_prod += parseFloat(get_data_detalle[i].total_line);
        // // //     total_comis += parseFloat(get_data_detalle[i].total_comission);

           
              
        // // //   }

        // // //   $("#txtTotalOrden").val(total_prod);
        // // //   $("#txt_totalComision").val(total_comis);
          ////************************************** */
          


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

                                 //console.log(cell.getRow().getData());
                                 let id_prod = cell.getRow().getData().id;
                                 const obj = cell.getRow().getData();
                                 let bandera = true;
 
                                  const get_data_detalle = table_detalle_factura.getData();
                                  //if( get_data_detalle.length != 0 || array_detalle_factura_eliminados.length > 0 ){
                                  if( get_data_detalle.length != 0  ){

                                     for (var i in get_data_detalle) {
                                       /* caso de que ubira sido elimindao*/
                                       if( (array_detalle_factura_eliminados.length) > 0  && ( get_data_detalle[i].product_id !== id_prod ) ){
                                        console.log("for de otro array de memoria");
                                          for (var x in array_detalle_factura_eliminados){
                                            if( array_detalle_factura_eliminados[x].product_id === id_prod || parseInt(array_detalle_factura_eliminados[x].product_id) === id_prod ){
                                                $.toast({
                                                  heading: 'Information',
                                                  text: 'El producto seleccionado se agregara con la cantidad que antes tenia',
                                                  showHideTransition: 'fade',
                                                  icon: 'info',
                                                  position: 'top-right'
                                              })
                                              //console.log(array_detalle_factura_eliminados[x]);

                                                table_detalle_factura.updateOrAddData([
                                                  {
                                                    id_detalle_product :array_detalle_factura_eliminados[x].id_detalle_product,
                                                    product_id : array_detalle_factura_eliminados[x].product_id,
                                                    name_product : array_detalle_factura_eliminados[x].name_product,
                                                    quantity : array_detalle_factura_eliminados[x].quantity,
                                                    price :  array_detalle_factura_eliminados[x].price,
                                                    discount_porcentage : array_detalle_factura_eliminados[x].discount_porcentage,
                                                    price_discount : array_detalle_factura_eliminados[x].price_discount,
                                                    comission : array_detalle_factura_eliminados[x].comission,
                                                    total_comission : array_detalle_factura_eliminados[x].total_comission,
                                                    total_line : array_detalle_factura_eliminados[x].total_line
                                                  }
                                                ]);

                                                //delete array_detalle_factura_eliminados[x];
                                                //array_detalle_factura_eliminados.splice(array_detalle_factura_eliminados[x], 1);
                                                array_detalle_factura_eliminados.splice(x,1);
                                                //console.log(array_detalle_factura_eliminados[x]);
                                                const uno = table_detalle_factura.getData();
                  
                                                var total = 0;
                                                var total_comi = 0;
                                                for (var i in uno) {
                                                  total_comi += parseFloat(uno[i].total_comission);
                                                  total += parseFloat(uno[i].total_line)
                                                }
                            
                                                $("#txtTotalOrden").val(total.toFixed(2));
                                                $("#txt_totalComision").val(total_comi.toFixed(2));
                            

                                                $("#modal-buscarProducto").modal("hide");
                                              bandera = false;
                                              return false;

                                            }
                                          }
                                          
                                       }//caso normal
                                       if( get_data_detalle[i].product_id === id_prod || parseInt(get_data_detalle[i].product_id) === id_prod ){
                                            $.toast({
                                              heading: 'Warning',
                                               text: 'El producto ya se encuentra en la lista. Seleccione otro Producto',
                                               showHideTransition: 'fade',
                                               icon: 'warning',
                                               position: 'top-right'
                                           })
                                         bandera = false;
                                         return false;
                                        }
                                     }
                                      if(bandera != false){
                                       table_detalle_factura.updateOrAddData([
                                           {
                                             id_detalle_product :0,
                                             product_id : obj.id,
                                             name_product : obj.name,
                                             quantity : 0,//obj.quantity,
                                             price :  obj.price,
                                             discount_porcentage : obj.discount,
                                             price_discount : obj.price_discount,
                                             comission : obj.comission,
                                             total_comission : obj.comission,
                                             total_line : 0
                                           }
                                       ]);
                                     }
 
                                  } 
                                  else if(array_detalle_factura_eliminados.length > 0){
                                    /**Agregado en el caso q se borren
                                    *  todos los elemento y queden en memoria
                                    */
                                      for (var x in array_detalle_factura_eliminados){
                                        if( array_detalle_factura_eliminados[x].product_id === id_prod || parseInt(array_detalle_factura_eliminados[x].product_id) === id_prod ){
                                            $.toast({
                                              heading: 'Information',
                                              text: 'El producto seleccionado se agregara con la cantidad que antes tenia',
                                              showHideTransition: 'fade',
                                              icon: 'info',
                                              position: 'top-right'
                                          })
                                          //console.log(array_detalle_factura_eliminados[x]);

                                         
                                            table_detalle_factura.updateOrAddData([
                                              {
                                                id_detalle_product :array_detalle_factura_eliminados[x].id_detalle_product,
                                                product_id : array_detalle_factura_eliminados[x].product_id,
                                                name_product : array_detalle_factura_eliminados[x].name_product,
                                                quantity : array_detalle_factura_eliminados[x].quantity,
                                                price :  array_detalle_factura_eliminados[x].price,
                                                discount_porcentage : array_detalle_factura_eliminados[x].discount_porcentage,
                                                price_discount : array_detalle_factura_eliminados[x].price_discount,
                                                comission : array_detalle_factura_eliminados[x].comission,
                                                total_comission : array_detalle_factura_eliminados[x].total_comission,
                                                total_line : array_detalle_factura_eliminados[x].total_line
                                              }
                                            ]);

                                            
                                            // La segunda opción pasa por hacer una llamada a la función splice() 
                                            // pasándole dos parámetros: el primero será el índice a partir del cual 
                                            // queremos borrar elementos y, el segundo, el número de elementos que 
                                            // queremos borrar a partir de la posición dada:

                                            //   array.splice(1,1);
                                            array_detalle_factura_eliminados.splice(x,1);
                                            
                                            //console.log(array_detalle_factura_eliminados);
                                            const uno = table_detalle_factura.getData();
              
                                            var total = 0;
                                            var total_comi = 0;
                                            for (var i in uno) {
                                              total_comi += parseFloat(uno[i].total_comission);
                                              total += parseFloat(uno[i].total_line)
                                            }
                        
                                            $("#txtTotalOrden").val(total.toFixed(2));
                                            $("#txt_totalComision").val(total_comi.toFixed(2));
                        

                                            $("#modal-buscarProducto").modal("hide");
                                          bandera = false;
                                          return false;

                                        }
                                      }
                                      if(bandera != false){
                                        table_detalle_factura.updateOrAddData([
                                            {
                                              id_detalle_product :0,
                                              product_id : obj.id,
                                              name_product : obj.name,
                                              quantity : 0,//obj.quantity,
                                              price :  obj.price,
                                              discount_porcentage : obj.discount,
                                              price_discount : obj.price_discount,
                                              comission : obj.comission,
                                              total_comission : obj.comission,
                                              total_line : 0
                                            }
                                        ]);
                                      }
                                   }
                                  else{
                                    console.log("else");
                                     table_detalle_factura.updateOrAddData([
                                       {
                                         id_detalle_product :0,
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
                                  }
           
                              $("#modal-buscarProducto").modal("hide");

                                // $("#textidentification").val(cell.getRow().getData().identification);
                                // $("#textbuscarcliente").val(cell.getRow().getData().name);
                                // $("#textaddressdelivery").val(cell.getRow().getData().address);
                                // $("#textbuscarcliente").attr("codigocliente", cell.getRow().getData().id);
                            
                            }},
      {title:"Codigo", field:"id",headerFilter:"input", headerFilterPlaceholder:"Codigo"},
      {title:"Nombre Producto", field:"name", width:190,headerFilter:"input", headerFilterPlaceholder:"Buscar Producto"},
      {title:"Precio", field:"price", sorter:"number", formatter:"money", formatterParams:{
        decimal:".",
        thousand:".",
        symbol:"$",
        symbolAfter:false,
        precision:2,
        }
      },
      {title:"Comision", field:"comission", formatter:"money", formatterParams:{
        decimal:".",
        thousand:".",
        symbol:"$",
        symbolAfter:false,
        precision:2,
        }
      },
      {title:"Cantidad", field:"quantity"},
      {title:"% DESCT", field:"discount",  formatter:"money", formatterParams:{
            decimal:".",
            thousand:".",
            symbol:"%",
            symbolAfter:"p",
            precision:false,
        }
      },
      {title:"PVP DESCT", field:"price_discount", formatter:"money", formatterParams:{
        decimal:".",
        thousand:".",
        symbol:"$",
        symbolAfter:false,
        precision:2,
        }
      },
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

    let bandera = true;

    const get_data_detalle_producto = table_detalle_factura.getData();

    let id_cliente_facturar = $('#textbuscarcliente').attr("codigocliente");
      
        
    if(id_cliente_facturar == '0'){
      $('.loaders').addClass('d-none');
            
        $.toast({
          heading: 'Error',
          text: 'Debe seleccionar Cliente',
          showHideTransition: 'fade',
          icon: 'error',
          position: 'top-right',
        })
        return false;
    }
    else if( get_data_detalle_producto.length != 0){
          for (var i in get_data_detalle_producto) {
             if(get_data_detalle_producto[i].quantity === 0 || get_data_detalle_producto[i].quantity === '' ){
                   
                msj_productos_sin_cantidad(); 
                bandera = false;
                return false;
             } 
          }

          if (bandera === false) {

            msj_productos_sin_cantidad();   

            bandera = false;
            return false;

          }else{
               cargarListaProductos();
              $("#modal-buscarProducto").modal("show");
               return false;
          }
        
    }else{
      cargarListaProductos();
      $("#modal-buscarProducto").modal("show");
    }
  });


  /**
   * funcion de mensaje de productos
   */
  function msj_productos_sin_cantidad(){
    $.toast({
      heading: 'Warning',
      text: 'Existe un producto que no tiene cantidad. Por favor ingrese cantidad para que pueda añadir un nuevo producto',
      position: 'top-right',
       icon: 'warning',
      stack: false
    })
  }

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
    var stock_en_bd;
    // La primera diferencia es que no se le pasa un callback,
    // La función devuelve una Promise
  
      jQuery.ajax({
        type: 'GET',
        url:$('#form-stock-productos').attr("action"),
        data: {
          id_producto: v_id_product
        },
        async: false,
        success : function(response){
          stock_en_bd = response.data[0].quantity;
        },
        error : function(error){rechazar(error)}
      });
      return stock_en_bd;
  }
  // function consultarStockProducto (v_id_product){
  //   //var stock;
  //   // La primera diferencia es que no se le pasa un callback,
  //   // La función devuelve una Promise
  //   return new Promise(function(resolver, rechazar){
  //     jQuery.ajax({
  //       type: 'GET',
  //       url:$('#form-stock-productos').attr("action"),
  //       data: {
  //         id_producto: v_id_product
  //       },
  //       async: false,
  //       success : function(response){
  //         resolver(response.data[0].quantity);
  //       },
  //       error : function(error){rechazar(error)}
  //     });
  //   });
  // }
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
                             
                                $("#textbuscarPedido").attr("id_orden",cell.getRow().getData().id);
                                $('#textbuscarPedido').val(cell.getRow().getData().id);
                                $('#txt_id_cab_orden').val(cell.getRow().getData().id);
                                $("#textbuscarcliente").val(cell.getRow().getData().nombre_cliente);
                                $("#textbuscarcliente").attr("codigocliente",cell.getRow().getData().client_id);
                                $("#textidentification").val(cell.getRow().getData().identification);
                                $("#textEmail").val(cell.getRow().getData().email_cliente);
                                $("#textphone1").val(cell.getRow().getData().phone1);
                                $("#textphone2").val(cell.getRow().getData().phone2);
                                $("#colaborador").val(cell.getRow().getData().nombre_usuario);
                                $("#colaborador").attr("id_colaborador",cell.getRow().getData().collaborator_id);
                                $("#fechaActual").val(cell.getRow().getData().delivery_date);
                                $("#horaActual").val(cell.getRow().getData().delivery_time);
                                $("#textaddressdelivery").val(cell.getRow().getData().delivery_address);
                                $("#textObservacion").val(cell.getRow().getData().observation);
                                $('#sectors').val(cell.getRow().getData().sector_cod).change();
                                $('#city').val(cell.getRow().getData().city_sale_cod).change();
                                let estado_orden = cell.getRow().getData().order_status_cod ;
                                if( estado_orden=== "OC" || estado_orden=== "OE" ){
                                  document.getElementById('btn-modal-buscar-producto').disabled=true;
                                  document.getElementById('btn-generarorden').disabled=true;
                                  document.getElementById("grid-detalles-div").disabled = true;
                                }else{
                                  document.getElementById('btn-modal-buscar-producto').disabled=false;
                                  document.getElementById('btn-generarorden').disabled=false;
                                  document.getElementById("grid-detalles-div").disabled = false;
                                }
                                $('#orderStatus').val(cell.getRow().getData().order_status_cod).change().prop('disabled', false);
                                //$('#orderStatus').prop('disabled', false);
                                $("#txtTotalOrden").val(cell.getRow().getData().total_order);
                                $("#txt_totalComision").val(cell.getRow().getData().total_comission);
                                $("#modal-buscarPedido").modal("hide");
                                const id_order_cab = cell.getRow().getData().id;
                                cargarDetallePedido(id_order_cab);

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
        // {title:"Cod Ciudad", field:"city_sale_cod"},//
        {title:"Nombre del Sector", field:"nombre_sector", headerFilter:"select", headerFilterParams:{values:true}, headerFilterPlaceholder:"Buscar Sector"}, //},
        {title:"Nombre de Ciudad", field:"nombre_ciudad", headerFilter:"select", headerFilterParams:{values:true}, headerFilterPlaceholder:"Buscar Ciudad"},  //},
        {title:"Nombre Estado Orden", field:"nombre_estado_ord", headerFilter:"select", headerFilterParams:{values:true}, headerFilterPlaceholder:"Buscar Estado"},  //headerFilter:"input",headerFilterPlaceholder:"Estado"},
        {title:"Nombre Colaborador", field:"nombre_colaborador", headerFilter:"input",headerFilterPlaceholder:"Colaborador"},  //},
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

  //table_lista_ordenes.hideColumn("sector_cod");

  /**
   * Procesar orden 
   */
  $(document).on("click", "#btn-procesar-orden",function(){



    let id_orden = $('#textbuscarPedido').attr('id_orden');
    let msj =  "Cambiar de estado";
    var tb_det_prodct = table_detalle_factura.getData();


    if(id_orden == 0){
      $('.loaders').addClass('d-none');
        
        $.toast({
          heading: 'Error',
          text: 'Debe seleccionar Pedido',
          showHideTransition: 'fade',
          icon: 'error',
          position: 'top-right',
      })
     return false;
    }
    Swal.fire({
      title: '<strong>' + msj + '</strong>',
      icon: 'info',
      html:
          'Procesar Orden',
      showCloseButton: true,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText:
          '<i class="fa fa-check"></i>',
      confirmButtonAriaLabel: 'Thumbs up, great!',
      cancelButtonText:
          '<i class="fa fa-times"></i>',
      cancelButtonAriaLabel: 'Thumbs down'
    }).then((result) => {
      if (result.value === true){
        $('.loaders').removeClass('d-none');
        $.ajax(
          {
            url : $('#form-procesar-orden').attr("action"),
            type: "POST",
            data : {
              _token: $('#token_procesar').val(),
              // opcion : id_orden=="0" ?'AA' : 'AB',
               id_pedido : id_orden,
              // client_id  :  $('#textbuscarcliente').attr("codigocliente"),
               delivery_date  : $('#fechaActual').val(),
              // delivery_time : $('#horaActual').val(),
               collaborator_id  : $('#colaborador').attr('id_colaborador'),
              // sector_cod  : $('#sectors').val(),
              // city_sale_cod  : $('#city').val(),
              // delivery_address : $('#textaddressdelivery').val(),
              // observation : $('#textObservacion').val()==="" ? "-" : $('#textObservacion').val(),
              // // status_comission : $('#').val(),
               order_status_cod  : $('#orderStatus').val(),
              // total_order : $('#txtTotalOrden').val(),
               total_comission :  $('#txt_totalComision').val(),
               detalleProductos : JSON.stringify(tb_det_prodct),
              // detalleProductosBorrar : JSON.stringify(array_detalle_factura_eliminados),

              
             
            }
          }).done(function(dt) {
              console.log(dt);
            $('.loaders').addClass('d-none');
            if(dt.data.out_cod === 8){
                  $('.loaders').addClass('d-none');
                  Swal.fire({
                       position: 'top-center',
                       icon: 'warning',
                       title: dt.data.out_msj+"<br/> Nro Orden: "+dt.data.out_id_order.padStart(6, 0) ,
                       showConfirmButton: false,
                       timer: 1500
                  });
              }else if(dt.data.out_cod === 7){
                $('.loaders').addClass('d-none');
                Swal.fire({
                     position: 'top-center',
                     icon: 'success',
                     title: dt.data.out_msj+"<br/>  Nro Orden: "+dt.data.out_id_order.padStart(6, 0) ,
                     showConfirmButton: false,
                     timer: 1500
                });
                window.location.reload();
              }
          }).fail(function(data) {
              console.log(data);    
              //alert( "error" );
              $('.loaders').addClass('d-none');
              if(data.status===500){
                  Swal.fire({
                  icon: 'error',
                  title: 'Error al Procesar Pedidos',
                  text: 'Error al Procesar Pedidos'
                })}
          }).always(function(data) {
              $('.loaders').addClass('d-none');
              //console.log(data);    
              //alert( "complete" );
          });


      }
    });

  });
  
  //Seccion busqueda por fecha
  $(document).on("click", "#btn-buscar-filtro-fecha-pedido",function(){

      cargarListaPedidosFecha();
      $("#modal-buscarPedido").modal("show");
  });

  function cargarListaPedidosFecha(){
    $.ajax({
        type: 'POST',
        url: $('#form-filtrar-buscar-orden_fecha').attr("action"),
        data: {
            _token: $('#token_filtar_bus_fecha').val(),
            fechaDesde: $('#fechaDesde').val(),
            fechaHasta: $('#fechaActual').val(),
        },

        beforeSend: function () {
            $('.loaders').removeClass('d-none');
        },
        success: function (response) {

        table_lista_ordenes.replaceData(response.data);

        }, complete: function () {
            $('.loaders').addClass('d-none');

        }
    });

  }



});