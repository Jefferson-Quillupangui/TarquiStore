$(document).ready(function () {

    let table_compras_por_cliente;
    let table_ventas_x_vendedor;
    let table_list_productos_vendidos;

    
    $(document).on("change", "#select-tipo-reporte",function(){
        $('#div-op-compras-clientes').addClass('d-none');
        $('#div-op-ventas-por-vendedor').addClass('d-none');
        $('#div-op-lista-productos-vendidos').addClass('d-none');
        let $comboReporte = $('#select-tipo-reporte').val();



        table_compras_por_cliente.clearData();
        table_ventas_x_vendedor.clearData();
        table_list_productos_vendidos.clearData();
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

    

    

});