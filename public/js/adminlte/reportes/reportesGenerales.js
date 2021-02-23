$(document).ready(function () {

    let table_compras_por_cliente;

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
            {title:"Estado", width:200,field:"name_estado",hozAlign:"center"},
            {title:"Identificacion" , width:200, field:"identification",hozAlign:"left"},
            {title:"Nombre Cliente", width:310, field:"name",hozAlign:"left"},
            {title:"Cantidad de Ordenes", field:"cantidad_ordenes",hozAlign:"center"},
            {title:"Total de Ordenes", field:"total_orden", formatter:"money", hozAlign:"right",formatterParams:{
                decimal:".",
                thousand:".",
                symbol:"$",
                symbolAfter:false,
                precision:2,
            }},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
    });

    

    $(document).on("click", "#btn-buscar-filtro-reportes",function(){
        let $comboReporte = $('#select-tipo-reporte').val();
        let $mes = $('#select-mes').val();
        let $anio = $('#anio_order').val();

        switch($comboReporte){
            case 'AA': 
                ComprasPorCliente("AA", $mes, $anio);
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
    
                if (response === 0) {
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
                title:"Compras", //add title to report
            });
          }
       
    });



    

});