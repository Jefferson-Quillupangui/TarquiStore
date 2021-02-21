// function funcion_primera(){ alert("Se ha lanzado la PRIMERA función");}
// document.onreadystatechange = () => {
//     if (document.readyState === 'interactive') {
//         funcion_primera();
//     }
//   };

$(document).ready(function () {

    let table_comisiones_colaboradores;
    let table_list_colaboradores;


    
    /**
     * Tabla de Comsiones del Colaborador
     * @param {*} cell 
     * @param {*} formatterParams 
     * @param {*} onRendered 
     */
    var iconAudito = function(cell, formatterParams, onRendered){ //plain text value
        return "<i class='fas fa-angle-right'></i>";
    };

    table_comisiones_colaboradores = new Tabulator("#grid-table-comisiones-colaboradores", {
        
        //layout:"fitColumns",
        //ajaxURL: '',
     
      // paginationSize:6,
        height:"380px",
        layout:"fitColumns",
        placeholder:"No hay Datos",
       // ajaxProgressiveLoad:"scroll",
      
        //pagination:"remote",
        //paginationSizeSelector:[3, 6, 8, 10],
        //movableColumns:true,
        columns:[
            // {formatter:iconAudito, width:40, hozAlign:"center"},
            {title:"N# MES", visible:false, field:"month",hozAlign:"center"},
            {title:"Mes", field:"mesDescription",hozAlign:"center"},
            {title:"Año", field:"year",hozAlign:"center"},
            {title:"Fecha Inicio", field:"month_start_date",hozAlign:"center"},
            {title:"Fecha Fin", field:"month_end_date",hozAlign:"center"},
            {title:"Cantidad Ordenes", field:"quantity_orders",hozAlign:"center",hozAlign:"center"},
            {title:"Total Comision", field:"total_comission", formatter:"money", hozAlign:"right",formatterParams:{
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
     * Lista de Colaboradores
     * @param {*} cell 
     * @param {*} formatterParams 
     * @param {*} onRendered 
     */
    var iconAudito = function(cell, formatterParams, onRendered){ //plain text value
        return "<i class='fas fa-angle-right'></i>";
    };

    table_list_colaboradores = new Tabulator("#table-list-colaboradores", {
        
        
        //ajaxURL: '',
     
      // paginationSize:6,
        height:"211px",
        //layout:"fitColumns",
        placeholder:"No hay Datos",
       // ajaxProgressiveLoad:"scroll",
      
        //pagination:"remote",
        //paginationSizeSelector:[3, 6, 8, 10],
        //movableColumns:true,
        columns:[
            {formatter:iconAudito, width:40, hozAlign:"center",
            cellClick:function(e, cell){
                const user_id = cell.getRow().getData().user_id;
                $("#txtNombreColaborador").val(cell.getRow().getData().name);
                $("#txtNombreColaborador").attr("id_colaborador",cell.getRow().getData().user_id);
                //cargarDetalleOrden(user_id);
                $("#modal-buscarColaboradores").modal("hide");
                        

            }},
            {title:"ID Cola", visible:false,field:"user_id",hozAlign:"center"},
            {title:"Identificaion", field:"identification",hozAlign:"center",headerFilter:"input",headerFilterPlaceholder:"Identificaion"},
            {title:"Nombre Usuario",width:200, field:"name",headerFilter:"input",headerFilterPlaceholder:"Nombre Usuario"},
            {title:"Email", field:"email",width:200,hozAlign:"center" ,headerFilter:"input",headerFilterPlaceholder:"Email"},
            {title:"Telefono", width:200,field:"phone",headerFilter:"input",headerFilterPlaceholder:"Telefono"},
           // {title:"Hora", field:"delivery_time",visible:false},
          ],
    });

    /**
     * Modal para buscar los colaboradores
     */
    $(document).on("click", "#btn-buscar-list-colaboradores",function(){
        cargarListaColaboradores();
        $("#modal-buscarColaboradores").modal("show");
    });

    $(document).on("click", "#btn-cancelar-modal-colaboradores",function(){
        $("#modal-buscarColaboradores").modal("hide");
    });

    /**
     * Funcion para buscar lista de colaboradores
     */
    function cargarListaColaboradores(){
        $.ajax({
            type: 'GET',
            url: $('#form-buscar-colaboradores').attr("action"),
            // data: {
            //     opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
            //     cod_prod: dat_busq
            // },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
             
                table_list_colaboradores.replaceData(response.data);
           
            }, complete: function () {
                $('.loaders').addClass('d-none');
               
            }
        });
    }


     /**
     * Modal para buscar los colaboradores
     */
    $(document).on("click", "#btn-buscar-comision",function(){
        let user_id = $("#txtNombreColaborador").attr("id_colaborador");
        let anio = $("#anio_order").val();
        if(user_id == 0 || user_id == "0" || user_id == ''){
            $('.loaders').addClass('d-none');
              
              $.toast({
                heading: 'Error',
                text: 'Debe seleccionar Colaborador',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else if(anio == 0 || anio == "0" || anio == ''){
            $('.loaders').addClass('d-none');
              
              $.toast({
                heading: 'Error',
                text: 'Debe seleccionar Año',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            cargarComisionUsuario(user_id, anio);
          }
    });
    /**
     * funcion para cargar las comisiones segun el 
     * usuario
     */
    function cargarComisionUsuario(user_id, anio){
        $.ajax({
            type: 'GET',
            url: $('#form-buscar-comision').attr("action"),
             data: {
            //     opcion: 'AC',//dat_busq === '' ? 'AA' : 'AB',
                _token: $('#token_buscar').val(),
                user_id: user_id,
                anio : anio
            },
            // dataType: "dataType",
            beforeSend: function () {
                $('.loaders').removeClass('d-none');
            },
            success: function (response) {
             //console.log(response.data);
                table_comisiones_colaboradores.replaceData(response.data);
           
            }, complete: function () {
                $('.loaders').addClass('d-none');
               
            }
        });
    }

    //trigger download of data.xlsx file
    document.getElementById("download-xlsx").addEventListener("click", function(){
        var tb_comisiones = table_comisiones_colaboradores.getData();
        var nombre = $('#txtNombreColaborador').val();
        const fecha = new Date();

        if(nombre == ""){
            $('.loaders').addClass('d-none');
              
              $.toast({
                heading: 'Error',
                text: 'Debe seleccionar Colaborador',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
            })
           return false;
          }else{
            table_comisiones_colaboradores.download("xlsx", nombre+"_"+fecha+".xlsx", {sheetName:"Colaborador-"+nombre});
          }
    });

    //trigger download of data.csv file
    document.getElementById("download-csv").addEventListener("click", function(){
        table_comisiones_colaboradores.download("csv", nombre+"_"+fecha+".csv" );
    });



    
    
    // if (document.readyState === 'complete') {
    //     funcion_primera();
    //   }
   

});
