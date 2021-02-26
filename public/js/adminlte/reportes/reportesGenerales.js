$(document).ready(function () {

    let table_compras_por_cliente;
    let table_ventas_x_vendedor;
    let table_list_productos_vendidos;
    let table_ventas_diaras_por_mes;
    let table_ventas_por_categorias;
    let table_pedidos_entregados;

    
    $(document).on("change", "#select-tipo-reporte",function(){
        $('#div-op-compras-clientes').addClass('d-none');
        $('#div-op-ventas-por-vendedor').addClass('d-none');
        $('#div-op-lista-productos-vendidos').addClass('d-none');
        $('#div-op-ventas-diarias-x-mes').addClass('d-none');
        $('#div-op-ventas-por-categoria').addClass('d-none');
        $('#div-op-pedidos-entregados').addClass('d-none');
        let $comboReporte = $('#select-tipo-reporte').val();



        table_compras_por_cliente.clearData();
        table_ventas_x_vendedor.clearData();
        table_list_productos_vendidos.clearData();
        table_ventas_diaras_por_mes.clearData();
        table_ventas_por_categorias.clearData();
        table_pedidos_entregados.clearData();
        // switch($comboReporte){
        //     case 'AA': 
        //         table_compras_por_cliente.clearData();
        //         break;
        // }
    });

    /**
     * Tabla Compras Por Clientes
     */
    table_compras_por_cliente = new Tabulator("#grid-table-compras-cliente", {
        
        //layout:"fitColumns",
        //ajaxURL: '',
     
      // paginationSize:6,
        height:"480px",
        //layout:"fitColumns",
        placeholder:"No hay Datos",
       // ajaxProgressiveLoad:"scroll",
      
        //pagination:"remote",
        //paginationSizeSelector:[3, 6, 8, 10],
        //movableColumns:true,
        columns:[
            // {formatter:iconAudito, width:40, hozAlign:"center"},
            // {title:"Estado", width:200,field:"name_estado",hozAlign:"center"},
            {title:"Identificacion" , width:200, field:"identification",hozAlign:"left"},
            {title:"Nombre Cliente", width:510, field:"name_complet",hozAlign:"left"},
            {title:"Cantidad de Ordenes",width:155, field:"cantidad_ordenes",hozAlign:"center"},
            {title:"Total de Ordenes",width:155, field:"total_orden", formatter:"money", hozAlign:"right",formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"$",
                symbolAfter:false,
                precision:2,
            }},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
    });

     /**
     * Tabla VEntas Por Vendedor
     */
    table_ventas_x_vendedor = new Tabulator("#grid-table-ventas-por-vendedor", {
       
        height:"380px",
        //layout:"fitColumns",
        placeholder:"No hay Datos",
       
        columns:[
           
            // {formatter:iconAudito, width:40, hozAlign:"center"},
            {title:"Identificacion",width:200, field:"identification",hozAlign:"left"},
            {title:"Nombre", width:510,field:"name",hozAlign:"left"},
            {title:"Cantidad Ordenes",width:155, field:"quantity_orders",hozAlign:"center",hozAlign:"center"},
            {title:"Total Comision",width:155, field:"total_comission", formatter:"money", hozAlign:"right",formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"$",
                symbolAfter:false,
                precision:2,
            }},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
        
    });

     /**
     * Tabla Listados de productos Vendidos
     */
    table_list_productos_vendidos = new Tabulator("#grid-table-lista-productos-vendidos", {
       
        height:"380px",
        //layout:"fitColumns",
        placeholder:"No hay Datos",
       
        columns:[
            // {formatter:iconAudito, width:40, hozAlign:"center"},
            {title:"Codigo de Producto",width:200, field:"codigo_producto",hozAlign:"left"},
            {title:"Nombre del producto", width:510,field:"name_product",hozAlign:"left"},
            {title:"Cantidad Vendidos",width:155, field:"catidad_vendidos",hozAlign:"center",hozAlign:"center"},
            {title:"Total Venta",width:155, field:"total_venta_product", formatter:"money", hozAlign:"right",formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"$",
                symbolAfter:false,
                precision:2,
            }},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
        
    });


      /**
     * Tabla Venta Por Categoria
     */
    table_ventas_por_categorias = new Tabulator("#grid-table-ventas-por-categoria", {
       
        height:"400px",
        //layout:"fitColumns",
        placeholder:"No hay Datos",
       
        columns:[
            //id,dia_mes,cantidad_ordenes,total_ordenes
            // {formatter:iconAudito, width:40, hozAlign:"center"},
            {title:"Codigo Categoria",width:200, field:"codigo_categoria",hozAlign:"left"},
            {title:"Nombre Categoria", width:510,field:"nombre_categoria",hozAlign:"left"},
            {title:"Cantidad Productos",width:155, field:"cantidad_productos",hozAlign:"center",hozAlign:"center"},
            {title:"Monto Total",width:155, field:"monto_total", formatter:"money", hozAlign:"right",formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"$",
                symbolAfter:false,
                precision:2,
            }},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
        
    });

     /**
     * Tabla Ventas Diaras Por Mes
     */
    table_ventas_diaras_por_mes = new Tabulator("#grid-table-ventas-diarias-por-mes", {
       
        height:"580px",
        //layout:"fitColumns",
        placeholder:"No hay Datos",
       
        columns:[
            //id,dia_mes,cantidad_ordenes,total_ordenes
            // {formatter:iconAudito, width:40, hozAlign:"center"},
            {title:"#",width:50, field:"id",hozAlign:"left"},
            {title:"Dia", width:510,field:"dia_mes",hozAlign:"left"},
            {title:"Cantidad Ordenes",width:155, field:"cantidad_ordenes",hozAlign:"center",hozAlign:"center"},
            {title:"Total Ordenes",width:155, field:"total_ordenes", formatter:"money", hozAlign:"right",formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"$",
                symbolAfter:false,
                precision:2,
            }},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
        
    });

    /**
     * Tabla para vizualizar los Pedidos Entregados
     */
    table_pedidos_entregados = new Tabulator("#grid-table-pedidos-entregados", {
       
        height:"580px",
        //layout:"fitColumns",
        placeholder:"No hay Datos",
       
        columns:[
            //id,dia_mes,cantidad_ordenes,total_ordenes
            // {formatter:iconAudito, width:40, hozAlign:"center"},
            {title:"Num Pedido",width:100, field:"id",hozAlign:"left"},
            {title:"Fecha",width:80, field:"delivery_date",hozAlign:"left"},
            {title:"Hora",width:80, field:"delivery_time",hozAlign:"left"},
            {title:"Nombre Cliente", width:220,field:"nombre_cliente",hozAlign:"left"},
            {title:"Identificacion", width:125,field:"identification",hozAlign:"left"},
            {title:"Correo", width:190,field:"email",hozAlign:"left"},
            {title:"Telefonos", width:150,field:"telefono",hozAlign:"left"},
            {title:"Sector", width:150,field:"sector",hozAlign:"left"},
            {title:"Ciudad", width:150,field:"nombre_ciudad",hozAlign:"left"},
            {title:"Direccion", width:220,field:"delivery_address",hozAlign:"left"},
            {title:"Total Ordenes",width:135, field:"total_order", formatter:"money", hozAlign:"right",formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"$",
                symbolAfter:false,
                precision:2,
            }},
            {title:"Vendedor",width:155, field:"nombre_colaborador",hozAlign:"center",hozAlign:"left"},
            {title:"Identificacion", width:135,field:"identification_colaborador",hozAlign:"left"},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
        
    });

    /**
     * Metodo para buscar los reportes
     */
    $(document).on("click", "#btn-buscar-filtro-reportes",function(){
        let $comboReporte = $('#select-tipo-reporte').val();
        let $mes = $('#select-mes').val();
        let $anio = $('#anio_order').val();

        switch($comboReporte){
            case 'AA': 
                ComprasPorCliente("AA", $mes, $anio);
                break;
            case 'AB' :
                VentasPorVendedor("AB", $mes, $anio);
            break;
            case 'AC' :
                ListaProductosVendidos("AC", $mes, $anio);
            break;
            case 'AD' :
                VentasDiarasPorMes("AD", $mes, $anio);
            break;
            case 'AE' :
                VentasPorCategoria("AE", $mes, $anio);
            break;
            case 'AF' :
                PedidosEntregados("AF", $mes, $anio);
            break;
            
            
        }
       
 
    });



    function ComprasPorCliente($opcion, $mes, $anio){
        $.ajax({
            type: 'GET',
            url: $('#form-compras-por-cliente').attr("action"),
             data: {
                 opcion: $opcion,//dat_busq === '' ? 'AA' : 'AB',
                 mes : $mes,
                 anio : $anio
             },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
                $('#div-op-compras-clientes').removeClass('d-none');
                if (response === 0) {
                    table_compras_por_cliente.clearData();
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'No Exite Registro!'
                        //footer: '<a href>Why do I have this issue?</a>'
                    });
                } else {
                    table_compras_por_cliente.replaceData(response);
                }
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
            }
        });
    }


    
     /**
     * Descargar Excel Compras por Cliente
     */
    //trigger download of data.xlsx file
    document.getElementById("download-reportes-xlsx").addEventListener("click", function(){
        var tabla_datos = table_compras_por_cliente.getData();
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(tabla_datos.length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            table_compras_por_cliente.download("xlsx", anio+"_"+mes+"_"+"ComprasPorCliente"+fecha+".xlsx", {sheetName:anio+"_"+mes+"_"+"ComprasXCliente"});
          }
    });

    
    /**
     * DEscargar PDF comisiones por usuario 
     */
    $(document).on("click", "#download-reportes-pdf",function(){
       
        
        const fecha = new Date();

        if(table_compras_por_cliente.getData().length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          } else{
              table_compras_por_cliente.download("pdf", "ComprasPorCliente"+"_"+fecha+".pdf", {
                orientation:"portrait", //set page orientation to portrait
                title:"Compras" //add title to report
                // autoTable:{ //advanced table styling
                //     styles: {
                //         fillColor: [100, 255, 255]
                //     },
                //     columnStyles: {
                //         id: {fillColor: 255}
                //     },
                //     margin: {top: 100},
                // },
                // documentProcessing:function(doc){
                //     //carry out an action on the doc object
                // }
            
            });
          }
       
    });

    //-------------------------------------------------------------------------------------------
    
    /**
     * Funcion para saber las ventas por vendedor
     */
    function VentasPorVendedor($opcion, $mes, $anio){
        $.ajax({
            type: 'GET',
            url: $('#form-vemtas-por-vendedor').attr("action"),
             data: {
                 opcion: $opcion,//dat_busq === '' ? 'AA' : 'AB',
                 mes : $mes,
                 anio : $anio
             },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
               
                $('#div-op-ventas-por-vendedor').removeClass('d-none');
                if (response === 0) {
                    table_ventas_x_vendedor.clearData();
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'No Exite Registro!'
                        //footer: '<a href>Why do I have this issue?</a>'
                    });
                } else {
                    table_ventas_x_vendedor.replaceData(response);
                }
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
            }
        });
    }

     /**
     * Descargar Excel Ventas Por Vendedor
     */
    $(document).on("click", "#download-reportes_V_X_V-xlsx",function(){
        var tabla_datos = table_ventas_x_vendedor.getData();
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(tabla_datos.length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            table_ventas_x_vendedor.download("xlsx", anio+"_"+mes+"_"+"Ventas_Por_Vendedor.xlsx", {sheetName:anio+" "+mes+" "+"VentasXVendedor"});
          }
    });

    /**
     * DEscargar PDF Ventas Por Vendedor
     */
    $(document).on("click", "#download-reportes_V_X_V-pdf",function(){
       
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(table_ventas_x_vendedor.getData().length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          } else{
              
            //downloadToTab
            table_ventas_x_vendedor.download("pdf", mes+"_"+anio+"_VentasPorVendedor.pdf", {
                orientation:"portrait ", //set page orientation to portrait
                title:"Ventas Por Vendedor  - Mes :  "+mes+"  - Año : "+anio,
                autoTable:{
                    margin: {top: 50},
                },
                documentProcessing:function(doc){
                    //carry out an action on the doc object
                }
            
            });
          }
       
    });

    /**
     * Funcion para ver la lista de productos vendidos
     */
    function ListaProductosVendidos($opcion, $mes, $anio){
        $.ajax({
            type: 'GET',
            url: $('#form-productos-vendidos').attr("action"),
             data: {
                 opcion: $opcion,//dat_busq === '' ? 'AA' : 'AB',
                 mes : $mes,
                 anio : $anio
             },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
               
                $('#div-op-lista-productos-vendidos').removeClass('d-none');
                if (response === 0) {
                    table_list_productos_vendidos.clearData();
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'No Exite Registro!'
                        //footer: '<a href>Why do I have this issue?</a>'
                    });
                } else {
                    table_list_productos_vendidos.replaceData(response);
                }
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
            }
        });
    }
     /**
     * Descargar Excel Lista Productos Vendidos
     */
    $(document).on("click", "#download-reportes_Lista_Product_Vendidos-xlsx",function(){
        var tabla_datos = table_list_productos_vendidos.getData();
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(tabla_datos.length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            table_list_productos_vendidos.download("xlsx", anio+"_"+mes+"_"+"Lista_Productos_Vendidos.xlsx", {sheetName:anio+" "+mes+" "+"ProductVendidos"});
          }
    });

    /**
     * DEscargar PDF Lista Productos Vendidos
     */
    $(document).on("click", "#download-reportes_Lista_Product_Vendidos-pdf",function(){
       
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(table_list_productos_vendidos.getData().length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          } else{
              
            //downloadToTab
            table_list_productos_vendidos.download("pdf", mes+"_"+anio+"_ListaProductosVendidos.pdf", {
                orientation:"portrait ", //set page orientation to portrait
                title:"Lista de Productos Vendidos  - Mes :  "+mes+"  - Año : "+anio,
                autoTable:{
                    margin: {top: 50},
                },
                documentProcessing:function(doc){
                    //carry out an action on the doc object
                }
            
            });
          }
       
    });

     /**
     * Funcion para Ver Ventas Diarias Por Mes
     */
    function VentasDiarasPorMes($opcion, $mes, $anio){
        $.ajax({
            type: 'GET',
            url: $('#form-ventas-diaria-mes').attr("action"),
             data: {
                 opcion: $opcion,//dat_busq === '' ? 'AA' : 'AB',
                 mes : $mes,
                 anio : $anio
             },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
               
                $('#div-op-ventas-diarias-x-mes').removeClass('d-none');
                if (response === 0) {
                    table_ventas_diaras_por_mes.clearData();
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'No Exite Registro!'
                        //footer: '<a href>Why do I have this issue?</a>'
                    });
                } else {
                    table_ventas_diaras_por_mes.replaceData(response);
                }
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
            }
        });
    }
 /**
     * Descargar Excel Ventas Diarias
     */
    $(document).on("click", "#download-reportes_Ventas_Diaras_X_Mes-xlsx",function(){
        var tabla_datos = table_ventas_diaras_por_mes.getData();
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(tabla_datos.length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            table_ventas_diaras_por_mes.download("xlsx", anio+"_"+mes+"_"+"Ventas_DiariasPorMes.xlsx", {sheetName:anio+" "+mes+" "+"Ventas Diaras"});
          }
    });

    /**
     * DEscargar PDF Pedidos Entregados
     */
    $(document).on("click", "#download-reportes_Ventas_Diaras_X_Mes-pdf",function(){
       
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(table_ventas_diaras_por_mes.getData().length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          } else{
              
            //downloadToTab
            table_ventas_diaras_por_mes.download("pdf", mes+"_"+anio+"_VentasDiarias.pdf", {
                orientation:"portrait ", //set page orientation to portrait
                title:"Ventas Diarias  - Mes :  "+mes+"  - Año : "+anio,
                autoTable:{
                    margin: {top: 50},
                },
                documentProcessing:function(doc){
                    //carry out an action on the doc object
                }
            
            });
          }
       
    });
    
    /**
     * Funcion para Ver Ventas Diarias Categoria
     */
    function VentasPorCategoria($opcion, $mes, $anio){
        $.ajax({
            type: 'GET',
            url: $('#form-ventas-por-categoria').attr("action"),
             data: {
                 opcion: $opcion,//dat_busq === '' ? 'AA' : 'AB',
                 mes : $mes,
                 anio : $anio
             },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
               
                $('#div-op-ventas-por-categoria').removeClass('d-none');
                if (response === 0) {
                    table_ventas_por_categorias.clearData();
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'No Exite Registro!'
                        //footer: '<a href>Why do I have this issue?</a>'
                    });
                } else {
                    // $("#myTextarea").val(JSON.stringify(response));
                    $("#txt_mes").val($mes);
                    $("#txt_anio").val($anio);
                   
                    table_ventas_por_categorias.replaceData(response);  
                }
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
            }
        });
    }

     /**
     * Descargar Excel Ventas Por Categoria
     */
    $(document).on("click", "#download-reportes_Ventas_X_Categorias-xlsx",function(){
        var tabla_datos = table_ventas_por_categorias.getData();
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(tabla_datos.length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            table_ventas_por_categorias.download("xlsx", anio+"_"+mes+"_"+"Ventas_Por_Categoria.xlsx", {sheetName:anio+" "+mes+" "+"Ventas X Categoria"});
          }
    });

    /**
     * DEscargar PDF Ventas Por Categoria
     */
    $(document).on("click", "#download-reportes_Ventas_X_Categorias-pdf",function(){
       
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(table_ventas_por_categorias.getData().length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          } else{
              
            //downloadToTab
            table_ventas_por_categorias.download("pdf", mes+"_"+anio+"_VentaPorCategoria.pdf", {
                orientation:"portrait", //set page orientation to portrait
                title:"Ventas Por Categoria  - Mes :  "+mes+"  - Año : "+anio,
                autoTable:{
                    margin: {top: 50},
                },
                documentProcessing:function(doc){
                    //carry out an action on the doc object
                }
            
            });
          }
       
    });

    /**
     * Funcion para ver los pedidos Entregados
     */
    function PedidosEntregados($opcion, $mes, $anio){
        $.ajax({
            type: 'GET',
            url: $('#form-pedidos-entregados').attr("action"),
             data: {
                 opcion: $opcion,//dat_busq === '' ? 'AA' : 'AB',
                 mes : $mes,
                 anio : $anio
             },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
               
                $('#div-op-pedidos-entregados').removeClass('d-none');
                if (response === 0) {
                    table_pedidos_entregados.clearData();
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Alerta!',
                        text: 'No Exite Registro!'
                        //footer: '<a href>Why do I have this issue?</a>'
                    });
                } else {
                    table_pedidos_entregados.replaceData(response);
                }
    
            }, complete: function () {
                $('.loaders').addClass('d-none');
            }
        });
    }

    /**
     * Descargar Excel Pedidos entregados
     */
    $(document).on("click", "#download-reportes_Pedidos_Entregados-xlsx",function(){
        var tabla_datos = table_pedidos_entregados.getData();
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(tabla_datos.length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            table_pedidos_entregados.download("xlsx", anio+"_"+mes+"_"+"Pedidos_Entregados.xlsx", {sheetName:anio+" "+mes+" "+"Pedidos Entregados"});
          }
    });
    
    /**
     * Descargar PDF Pedidos Entregados
     */
    $(document).on("click", "#download-reportes_Pedidos_Entregados-pdf",function(){
       
        var anio = $('#anio_order').val();
        var mes =  $('select[id="select-mes"] option:selected').text();
        const fecha = new Date();

        if(table_pedidos_entregados.getData().length === 0){
            $.toast({
                heading: 'Error',
                text: 'No hay datos para generar archivo',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          } else{
              
            //downloadToTab
            table_pedidos_entregados.download("pdf", mes+"_"+anio+"_PedidosEntregados.pdf", {
                orientation:"landscape", //set page orientation to portrait
                title:"Pedidos Entregados  - Mes :  "+mes+"  - Año : "+anio,
                autoTable:{
                    margin: {top: 50},
                },
                documentProcessing:function(doc){
                    //carry out an action on the doc object
                }
            
            });
          }
       
    });

});