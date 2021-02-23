$(document).ready(function () {

    let table_compras_por_cliente;
    let table_ventas_x_vendedor;

    
    $(document).on("change", "#select-tipo-reporte",function(){
        $('#div-op-compras-clientes').addClass('d-none');
        $('#div-op-ventas-por-vendedor').addClass('d-none');
        let $comboReporte = $('#select-tipo-reporte').val();



        table_compras_por_cliente.clearData();
        table_ventas_x_vendedor.clearData();
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
    table_ventas_x_vendedor = new Tabulator("#div-op-ventas-por-vendedor", {
       
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
     * Descargar Excel de Comisiones por Usuario
     */
    //trigger download of data.xlsx file
    document.getElementById("download-reportes-xlsx").addEventListener("click", function(){
        var tabla_datos = table_compras_por_cliente.getData();
        var nombre = $('#txtNombreColaborador').val();
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
            table_compras_por_cliente.download("xlsx", "ComprasPorCliente"+fecha+".xlsx", {sheetName:"Compras Por Cliente"});
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

    

});