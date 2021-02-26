@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    
@stop

@section('content_header')
  <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')



<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>Pedidos pendientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Pedidos entregados</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>Pedidos reagendados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Pedidos cancelados</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('list_orders')}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable ui-sortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">

            <div class="card-header ui-sortable-handle" style="cursor: move;">

              <h3 class="card-title">
                {{-- <i class="fas fa-chart-pie mr-1"></i> --}}
                <i class="fas fa-shopping-cart"></i>
                Productos más vendidos
              </h3>

              {{-- <div class="card-tools">
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

                  {{-- <canvas id="myChart" width="400" height="400"></canvas> --}}
                  <canvas id="myChart" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>

                </div>

                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">

                  <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>     

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
                <i class="far fa-user-circle"></i>
                Clientes
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
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
              label: '10 Productos más vendidos',
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: [
                  'rgba(255, 99, 132)',
                  'rgba(54, 162, 235)',
                  'rgba(255, 206, 86)',
                  'rgba(75, 192, 192)',
                  'rgba(153, 102, 255)',
                  'rgba(255, 159, 64)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
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
  </script>

<script>
  var ctx = document.getElementById('myChart2').getContext('2d');
  var myChar2 = new Chart(ctx, {
      type: 'doughnut',
      data: {
          labels: ['Mujeres', 'Hombres'],
          datasets: [{
              label: '10 Productos más vendidos',
              data: [20, 10],
              backgroundColor: [
                  'rgba(255, 99, 132)',
                  'rgba(54, 162, 235)',
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
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
  </script>
  

@stop