@extends('adminlte::page')

@section('title', 'Mi Dashboard')

@section('css')
    
@stop

@section('content_header')
  <h1 class="m-0 text-dark">Mi Dashboard</h1>
@stop

@section('content')

<form action="#" id="form-dash" method="POST">
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</form>

<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$order_p->pendientes}}</h3>

              <p>Pedidos pendientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            {{-- <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a> --}}
            <a class="small-box-footer">&nbsp;</a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $order_e->entregados }}<sup style="font-size: 20px"></sup></h3>

              <p>Pedidos entregados</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            {{-- <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a> --}}
            <a class="small-box-footer">&nbsp;</a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $order_r->reagendados }}</h3>

              <p>Pedidos reagendados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            {{-- <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a> --}}
            <a class="small-box-footer">&nbsp;</a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $order_c->cancelados }}</h3>

              <p>Pedidos cancelados</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            {{-- <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a> --}}
            <a class="small-box-footer">&nbsp;</a>
          </div>

        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">

        <section class="col-lg-7 connectedSortable ui-sortable">

          <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
              <h3 class="card-title">
                <i class="fas fa-shopping-cart"></i>
                Productos más vendidos
              </h3>

            </div>

            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                    <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                  </div>

                  <canvas id="myChart" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>

                </div>
              </div>
            </div>
          </div>

        </section>

        <section class="col-lg-5 connectedSortable ui-sortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">

            <div class="card-header ui-sortable-handle" style="cursor: move;">

              <h3 class="card-title">
                <i class="fas fa-tags"></i>
                Categorias más vendidas
              </h3>
{{-- 
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                  </li>
                </ul>
              </div> --}}

            </div><!-- /.card-header -->

            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                  <div class="chartjs-size-monitor">

                    <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                    <div class="chartjs-size-monitor-shrink"><div class=""></div></div>

                  </div>
                  {{-- <canvas id="myChart2" width="50" height="50" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas> --}}
                  <canvas id="myChart2" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>
                  

                </div>

                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>                         
                </div>  

              </div>
            </div>

          </div>
        </section>
        
        {{-- <section class="col-lg-5 connectedSortable ui-sortable">
        </section> --}}

      </div>

    </div>  
</section>


@stop



@section('js')
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script> --}}
<script type="text/javascript" src="{{ asset("vendor\chart.js\Chart.min.js") }}"></script>

<script>
    
  var productos=[];
  var valores=[];

  //Petición de productos
  $.ajax({
  url:  'top_product_user',//"{{route('top.product')}}", // 'top_product',
  method: 'POST',
  data:{
    _token: $('input[name="_token"]').val()
  }
  }).done(function(res){
   
    var arreglo = JSON.parse(res);
    //console.log(arreglo);
    
    for(var x=0;x<arreglo.length;x++){
      productos.push(arreglo[x].name_product);
      valores.push(arreglo[x].cantidad);
    }
    generarGrafica(); //Generar grafica con datos del arreglo
    //alert(res);
  });

  //Funcion de grafica
  function generarGrafica(){
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productos,
            datasets: [{
                label: 'Cantidad vendida',
                data: valores,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                        
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: false
                    }
                }]
              }
        }
    }); 
  }

  </script>

<script>

  var genero=[];
  var cantidad=[];

  //Petición de productos
  $.ajax({
  url: '/top_categories_user',
  method: 'POST',
  data:{
    _token: $('input[name="_token"]').val()
  }
  }).done(function(res){

    var arreglo = JSON.parse(res);
    
    for(var x=0;x<arreglo.length;x++){

      genero.push(arreglo[x].name);
      cantidad.push(arreglo[x].cantidad_vendidos);
    }
    generarGrafica2(); //Generar grafica con datos del arreglo
    //alert(res);
  });

  function generarGrafica2(){

    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChar2 = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: genero,
            datasets: [{
                label: 'Clientes por género',
                data: cantidad,
                backgroundColor: [
                    'rgba(54, 162, 235)',
                    'rgba(255, 99, 132)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
  }
  </script>
  

@stop