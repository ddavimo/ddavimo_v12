
@section('content')
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

<div class="card ">
        <div class="card-header"> 
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning" style="color:blue;">                                   
                                        <i class="nc-icon nc-satisfied text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">CUMPLE</p>
                                        <h4 class="card-title" style="font-size;24px;">{{$lscumple}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"> 
                                AUDITORIAS SATISFACTORIAS
                            </div>
                        </div>
                    </div>
                </div>               
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning"  style="color:red;">                                         
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">ALERTAS</p>
                                        <h4 class="card-title" >{{$lsalertas}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                AUDITORIAS EN ALERTA
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning" style="color:#7d3c98;">
                                        <i class="nc-icon nc-single-copy-04 text-info"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">TOTAL AUDITORIAS</p>
                                        <h4 class="card-title" >{{$lcounta}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                TOTAL AUDITORIAS
                            </div>
                        </div>
                    </div>
                </div>
                @if($emp_type == 7 or $emp_type == 8)
                @if($lsgraf !== 0)
                    @foreach($lsgraf as $valor =>$spk)                       
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon" >                         
                                    @if($valor%2 == 0)    
                                        <div class="card-icon">                                         
                                            <i class="nc-icon nc-headphones-2" style="color:white;"></i>  
                                        </div>
                                    @else
                                        <div class="card-icon"  id="divcolor" >           
                                            <i class="nc-icon nc-headphones-2"></i> 
                                        </div> 
                                    @endif                                     
                                    <p class="card-category">TOTAL: {{$spk->cant}}  </p>
                                    <h3 class="card-title">  <small>Cumple:</small> {{$spk->cumple}} <br> <small>Alertas:</small> {{$spk->alerta}}                                
                                    </h3>
                                </div>
                                <div class="card-footer "  style="color:red;">
                                    <hr>
                                    <div class="stats" style="color: #12b9f3;">
                                    <p style="color:grey"> {{$spk->sponsor}} / <span style="color:   #a8dcd7  "> {{$spk->canal}} </span></p>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                  
                    @endforeach  
                    @endif
                @endif            
            </div>                    
        </div> 
 </div>
 @if($lcounta > 0)
    @if($emp_type == 7 or $emp_type == 8)
        <div class="card ">
            <div class="col-md-12" id="grafic"> 
                <div class="col-lg-6 col-sm-6">
                    <div class="card-header ">
                        <h5 class="card-title">Evaluaciones</h5>
                        <p class="card-category">Expresado en %</p>
                    </div>
                    <canvas id="myChart3" width="600" height="400"></canvas>
                </div>               
                <div class="col-lg-6 col-sm-">
                    <div class="card-header ">
                        <h5 class="card-title">Gestion de Auditorias</h5>
                        <p class="card-category">Expresado en Auditorias</p>
                    </div>
                    <canvas id="myChart" width="600" height="400"></canvas>
                </div>              
            </div>
        </div>
    @endif
@else                
<div class="card">
    <div class="col-md-12"><br>
        <div class="alert alert-danger alert-with-icon" data-notify="container" id="cumple">                    
            <span data-notify="icon" class="nc-icon nc-bell-55"></span>
            <span><b> Atencion: </b> No existen Registros que mostrar.</span>
        </div> 
    </div>  
</div>   
@endif
@if($lcounta > 0)
    @if($emp_type == 7 or $emp_type == 8)      
        <div class="card  card-tasks">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-header ">
                        <h4 class="card-title">Gestion de Alertas</h4> 
                        <p class="card-category">Auditorias en Alerta - Top 5</p>                  
                    </div>
                    @if($ltopcount > 0)
                        <div class="card-body ">
                            <div class="table-full-width">
                                <table class="table" id="tablealert">
                                    <thead>
                                        <th data-field="name" data-sortable="true">Sponsor</th>
                                        <th data-field="name" data-sortable="true">Canal</th>
                                        <th data-field="salary" data-sortable="true">Campaña</th>
                                        <th>Cant</th>  
                                    </thead>
                                    <tbody>                           
                                        @foreach($ltop as $top)
                                        <tr>                       
                                            <td id="sp">{{ $top->sponsor }}</td>
                                            <td id="sp">{{ $top->canal }}</td>
                                            <td id="sp">{{ $top->cia }}</td>                 
                                            <td >{{ $top->alerta }}</td> 
                                            <td></td>                       
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else                 
                        <div class="col-md-12"><br>
                            <div class="alert alert-info alert-with-icon" data-notify="container" id="cumple">                    
                                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                <span><b> Info: </b> No se han Registrado Alertas.</span>
                            </div> 
                        </div>                  
                    @endif
                </div>              
                <div class="col-md-6">              
                    <div class="card-header ">
                        <h4 class="card-title">Auditorias del dia:  {{date('d-m-Y', strtotime($today)) }}</h4>  
                        <p class="card-category">Detalle x Ejecutivo</p>                   
                    </div>
                    @if($ejeccount>0)
                        <div class="card-body ">
                            <div class="table-full-width">
                                <table class="table" id="tableeje">
                                    <thead>
                                        <th data-field="name" data-sortable="true">Ejecutivo</th>
                                        <th data-field="salary" data-sortable="true">Alertas</th>
                                        <th data-field="salary" data-sortable="true">% Alertas</th>
                                        <th data-field="salary" data-sortable="true">Cumple</th>
                                        <th data-field="salary" data-sortable="true">% Cumple</th>
                                        <th data-field="salary" data-sortable="true">Total</th>       
                                    </thead>
                                    <tbody>                           
                                        @foreach($ejecutivos as $ejecu)
                                            <tr>                       
                                                <td>{{ $ejecu->ejec }}</td>
                                                <td class="tdeje">{{ $ejecu->alerta }}</td>
                                                <td class="tdeje">{{ round(($ejecu->alerta / $ejecu->cant)*100) }}%</td>  
                                                <td class="tdeje">{{ $ejecu->cumple }}</td>
                                                <td class="tdeje">{{ round(($ejecu->cumple / $ejecu->cant)*100) }}%</td>  
                                                <td class="tdeje">{{ $ejecu->cant }}</td>  
                                                <td></td>                      
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>               
                    @else
                        <div class="col-md-12"><br>
                            <div class="alert alert-info alert-with-icon" data-notify="container" id="cumple">                    
                                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                <span><b> Info: </b> No se han Registrado Auditorias el dia {{date('d-m-Y', strtotime($today)) }}</span>
                            </div> 
                        </div>
                    @endif
                </div>
            </div>
        </div>      
    @endif
@endif

@if($lcounta > 0)
    @if($emp_type == 7 or $emp_type == 8)     
        <div class="row">   
            <div class="col-md-12">
                <div class="card regular-table-with-color">
                    <div class="card-header ">
                        <h4 class="card-title">Gestion de Auditorias</h4>
                        <p class="card-category">Detalle x dia</p>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover" ID="tabledia">
                            <thead>
                                <th>Dias</th>
                                @foreach($calend as $dias)                                                                     
                                    <th >{{$dias->fecha}}</th>                                    
                                @endforeach
                            </thead>
                            <tbody>
                                <tr class="info">
                                    <td class='titd'>Cumple</td>
                                    @foreach($calend as $dias)                                                                     
                                        <td  class="tit">{{ $dias->cumple }}</td>                                    
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class='titd'>Alertas</td>
                                    @foreach($calend as $dias)                                                                     
                                        <td  class="tit">{{ $dias->alerta }}</td>                                    
                                    @endforeach
                                </tr>
                                <tr class="warning">
                                    <td class='titd'>Total</td>
                                    @foreach($calend as $dias)                                                                     
                                        <td  class="tit">{{ $dias->cant }}</td>                                    
                                    @endforeach                                              
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($emp_type == 7 or $emp_type == 1 ) 
       
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <form id="wizardForm" method="" action="">
                                <div class="card card-wizard">
                                    <div class="card-header ">
                                        <h5 class="card-title text-left">Detalle de Gestion</h5>
                                        <p class="card-category text-left">Split a complicated flow in multiple steps</p>
                                    </div>
                                    <div class="card-body ">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#tab1" data-toggle="tab" role="tab" aria-controls="tab1" aria-selected="true">Auditorias dia: {{date('d-m-Y', strtotime($today)) }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab2" data-toggle="tab" role="tab" aria-controls="tab2" aria-selected="true">TOP ALERTAS</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab3" data-toggle="tab" role="tab" aria-controls="tab3" aria-selected="true">TOP EJECUTIVOS</a>
                                            </li>
                                        </ul>    
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">  
                                                @if($ejeccount>0)
                                                    <div class="card-body ">
                                                        <div class="table-full-width">
                                                            <table class="table" id="tableeje">
                                                                <thead>
                                                                    <th data-field="name" data-sortable="true">Ejecutivo</th>
                                                                    <th data-field="salary" data-sortable="true">Alertas</th>
                                                                    <th data-field="salary" data-sortable="true">% Alertas</th>
                                                                    <th data-field="salary" data-sortable="true">Cumple</th>
                                                                    <th data-field="salary" data-sortable="true">% Cumple</th>
                                                                    <th data-field="salary" data-sortable="true">Total</th>       
                                                                </thead>
                                                                <tbody>                           
                                                                    @foreach($ejecutivos as $ejecu)
                                                                        <tr>                       
                                                                            <td>{{ $ejecu->ejec }}</td>
                                                                            <td class="tdeje">{{ $ejecu->alerta }}</td>
                                                                            <td class="tdeje">{{ round(($ejecu->alerta / $ejecu->cant)*100) }}%</td>  
                                                                            <td class="tdeje">{{ $ejecu->cumple }}</td>
                                                                            <td class="tdeje">{{ round(($ejecu->cumple / $ejecu->cant)*100) }}%</td>  
                                                                            <td class="tdeje">{{ $ejecu->cant }}</td>  
                                                                            <td></td>                      
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>               
                                                @else  
                                                    <div class="col-md-12"><br>
                                                        <div class="alert alert-info alert-with-icon" data-notify="container" id="cumple">                    
                                                            <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                                            <span><b> Info: </b> No se han Registrado Auditorias el dia {{date('d-m-Y', strtotime($today)) }}</span>
                                                        </div> 
                                                    </div>
                                                @endif                                           
                                            </div>
                                            <div class="tab-pane fade" id="tab2" role="tabpanel">
                                                @if($ltopcount > 0)
                                                    <div class="card-body ">
                                                        <div class="table-full-width">
                                                            <table class="table" id="tablealert">
                                                                <thead>
                                                                    <th data-field="name" data-sortable="true">Sponsor</th>
                                                                    <th data-field="name" data-sortable="true">Canal</th>
                                                                    <th data-field="salary" data-sortable="true">Campaña</th>
                                                                    <th>Cant</th>  
                                                                </thead>
                                                                <tbody>                           
                                                                    @foreach($ltop as $top)
                                                                    <tr>                       
                                                                        <td id="sp">{{ $top->sponsor }}</td>
                                                                        <td id="sp">{{ $top->canal }}</td>
                                                                        <td id="sp">{{ $top->cia }}</td>                 
                                                                        <td >{{ $top->alerta }}</td> 
                                                                        <td></td>                       
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @else                 
                                                    <div class="col-md-12"><br>
                                                        <div class="alert alert-info alert-with-icon" data-notify="container" id="cumple">                    
                                                            <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                                            <span><b> Info: </b> No se han Registrado Alertas.</span>
                                                        </div> 
                                                    </div>                  
                                                @endif                                                                    
                                            </div>
                                            <div class="tab-pane fade" id="tab3" role="tabpanel">       
                                            <h1>tab3</h1>                                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            -->
    @endif





@endif


<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<!-- GRAFICOS  -->
<script>
    var sites = {!! json_encode($infograb) !!};  
    var ctx = document.getElementById('myChart').getContext('2d');   
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [ 'Alertas', 'Cumple','Total'],
            datasets: [{
                label: '# de Auditorias',               
                data: [sites[0],sites[1],sites[2]],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,           
        }        
    });
</script>

<script>
    var sites2 = {!! json_encode($infograb2) !!};  
    var ctx = document.getElementById('myChart2').getContext('2d');
    ctx.canvas.width = 400;
    ctx.canvas.height = 350;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [ '% Nota Parcial', '% Nota Final','% Cumpl'],
            datasets: [{
                label: '% Promedio',
                data: [sites2[0],sites2[1],sites2[2]],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
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
            responsive: false,
        }
    });

</script>

<script>

    var sites = {!! json_encode($name) !!};  
    var sites3 = {!! json_encode($alt) !!};  
    var sites2 = {!! json_encode($cum) !!};  
    var densityData = {
    label: 'Cumple',
    data: [sites2[0],sites2[1],sites2[2],sites2[3],sites2[4],sites2[5]],
    backgroundColor: 'rgba(235, 137, 60)',
    borderColor: 'rgba(0, 99, 132, 1)',
    //   yAxisID: "y-axis-density"
    };
    
    var gravityData = {
    label: 'Alertas',
    data: [sites3[0],sites3[1],sites3[2],sites3[3],sites3[4],sites3[5]],
    backgroundColor: 'rgba(17, 191, 227)',
    borderColor: 'rgba(99, 132, 0, 1)',
    //   yAxisID: "y-axis-gravity"
    };
    
    var planetData = {
    labels: [sites[0],sites[1],sites[2],sites[3],sites[4],sites[5]],
    datasets: [densityData, gravityData]
    };
    
    var chartOptions = {
    //   scales: {
    //     xAxes: [{
    //       barPercentage: 100,
    //       categoryPercentage: 100
    //     }],
    //     yAxes: [{
    //       id: "y-axis-density"
    //     }, {
    //       id: "y-axis-gravity"
    //     }]
    //   }
    };

    var densityCanvas = document.getElementById('myChart3').getContext('2d');    
    var barChart = new Chart(densityCanvas, {
    type: 'bar',
    data: planetData,
    options: chartOptions
    });

</script>

<style>
    .tdeje {
        text-align: center;
    }

    #grafic{
        display:flex;
    }
    .table td {
        font-size:10px;
    }
    #tab {
        display: flex;
    }   
</style>

<style type="text/css">

    .tit {
        width: 4%;
        /* border: 1px solid blue; */
    }

    .titd {
        width: 15%;
        width: 100px;
        /* word-wrap: break-word; */
        /* border: 1px solid blue; */
    }

        .card .card-header-warning .card-icon,
        .card .card-header-warning .card-text,
        .card .card-header-warning:not(.card-header-icon):not(.card-header-text),
        .card.bg-warning,
        .card.card-rotate.bg-warning .front,
        .card.card-rotate.bg-warning .back {
        background: linear-gradient(90deg, #ffa726, #fb8c00);
        }

    


        .card .card-header-warning .card-icon,
        .card .card-header-warning:not(.card-header-icon):not(.card-header-text),
        .card .card-header-warning .card-text {
        box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);
        }

        .card .card-header.card-header-icon .card-title,
        .card .card-header.card-header-text .card-title {
        margin-top: 0px;
        color: #3C4858;
        }

        .card-stats .card-header.card-header-icon,
        .card-stats .card-header.card-header-text {
        text-align: right;
        }

        .card-stats .card-header.card-header-icon i {
        font-size: 46px;
        line-height: 56px;
        width: 56px;
        height: 56px;
        text-align: center;
        }

        .card [class*="card-header-"] .card-icon,
        .card [class*="card-header-"] .card-text {
        border-radius: 3px;
        background-color: #999999;
        padding: 15px;
        margin-top: -20px;
        margin-right: 15px;
        float: left;
        }

        .card-stats .card-header .card-icon+.card-title,
        .card-stats .card-header .card-icon+.card-category {
        padding-top: 10px;
        }

        .card .card-footer .stats .material-icons {
            position: relative;
            top: -10px;
            margin-right: 3px;
            margin-left: 3px;
            font-size: 18px;
        }

        #tablealert td, #tabledia td, #tableeje td {
            font-size: 10px;  
            /* font-family: inherit;   */
            font-family: "Open Sans", sans-serif;
        }   

</style>



@endsection
 