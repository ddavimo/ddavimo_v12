@extends('layouts.menu')
@auth
@section('content')

<div class="col-md-12">
    <div class="card ">
        <div class="card-header"> 
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">                                   
                                        <i class="nc-icon nc-satisfied text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Cumple</p>
                                        <h4 class="card-title">{{$cumple}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-check" aria-hidden="true"></i> Auditorias satisfactorias
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">                                         
                                        <i class="nc-icon nc-simple-remove text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Alertas</p>
                                        <h4 class="card-title">{{$alerta}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-check"></i> Auditorias en Alerta
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-paper-2 text-info"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Total Auditorias</p>
                                        <h4 class="card-title">{{$auditCount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-check"></i> Total
                            </div>
                        </div>
                    </div>
                </div>          
            </div>  
            <div id="botn">                     
                    <a href="{{ route('NewAudit') }}" class="btn btn-warning" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Nuevo</a>                    
                    <a href="{{ route('excelaud') }}" class="btn btn-success" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Excel</a>  
                    <div id="bqrut">        
                    <input type="text" class="form-control" name="inputUno" id="search" placeholder="Buscar">              
                </div> 
            </div>                       
        </div>   
        <div class="card-body ">  
        <hr>                             
        <div id="c01">
            <div class="card-body">
                @if($auditCount > 0)
                    <table class="table table-hover" id="tb01">
                        <thead>
                            <th data-field="name" data-sortable="true">Id</th>
                            <th data-field="name" data-sortable="true">Sponsor</th>
                            <th data-field="name" data-sortable="true">Canal</th>
                            <th data-field="name" data-sortable="true">Campaña</th>
                            <th data-field="name" data-sortable="true">Periodo</th> 
                            <th data-field="name" data-sortable="true">Operador</th>  
                            <th data-field="name" data-sortable="true">Cliente</th> 
                            <th data-field="name" data-sortable="true">Fecha</th> 
                            <th data-field="name" data-sortable="true">Estado</th>
                            <th data-field="name" data-sortable="true">%Pcl</th>
                            <th data-field="name" data-sortable="true">%Final</th>
                            @if($emp_type == 7)  
                            <th data-field="name" data-sortable="true">Ejec</th>                           
                            <th data-field="name" data-sortable="true">Del</th>
                            @endif                                    
                            <th data-field="name" data-sortable="true">Det</th> 
                        </thead>
                        <tbody>
                            @foreach($auditadas as $resp)                                                                                                                
                                <tr>
                                    <td>{!! $resp->id !!}</td>  
                                    <td>{!! $resp->sname !!}</td>
                                    <td>{!! $resp->canal !!}</td>  
                                    <td>{!! $resp->campania !!}</td>  
                                    <td class="text-right">{!! $resp->mes !!}/{!! $resp->anio !!}</td>                                     
                                    @if($resp->nombre == "EJECUTIVO SIN PRESENTACION")
                                        <td style="color:red;">{!! $resp->nombre !!}</td> 
                                    @else 
                                        <td>{!! $resp->nombre !!}</td> 
                                    @endif
                                    <td>{!! $resp->rutcli !!}-{!! $resp->dvcli !!}</td>   
                                    <td>{!! date('d-m-Y', strtotime($resp->created_at)) !!}</td>
                                    @if($resp->Estado == "ALERTA")                 
                                        <td style="color:red;"> 
                                    @else
                                        <td> 
                                    @endif{!! $resp->Estado !!}</td> 
                                    <td class="text-right">{!! $resp->npartial !!} %</td> 
                                    <td class="text-right">{!! $resp->nfinal !!} %</td>
                                    @if($emp_type == 7) 
                                        <td>{!! $resp->name !!}</td>                                                                                 
                                        <td class="text-right">                                    
                                            <button id="del" onclick="eliminarArticulo({{$resp->id}})" class="btn btn-outline btn-danger"><i class="fa fa-trash"></i></button>
                                        </td>  
                                    @endif
                                    <td class="text-right">
                                        <a href="#PlaceModal-{{$resp->id}}" data-toggle="modal"><i class="fa fa-search"></i></a>
                                    </td>                                                                                                                  
                                </tr>                                        
                            @endforeach
                        </tbody>
                    </table>                       
                @else
                    <div class="alert alert-danger alert-with-icon" data-notify="container" id="cumple">                    
                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                        <span><b> Atencion:  </b> No existen Registros que mostrar.</span>
                    </div>
                @endif
            </div>
        </div>  
        </div>
    </div>
</div>
<!-- modal  -->
    @foreach($auditadas as $resp)
        <div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($resp->Estado == "ALERTA")
                            <h5  id="tit01" class="modal-title" id="myModalLabel" style="color:red;"> Detalle de Evaluacion #  {{$resp->id}} / Estado: {{$resp->Estado}} </h5>
                        @else               
                            <h5  id="tit01" class="modal-title" id="myModalLabel"> Detalle de Evaluacion #  {{$resp->id}} / Estado: {{$resp->Estado}} </h5>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                  
                    </div>            
                    <div class="modal-body">   
                        <hr> 
                        <div class="row" id="det01">
                            <div class="col-sm-12" > Sponsor : {{$resp->sname}}  -  Canal: {{$resp->canal}} - Campaña : {{$resp->campania}} </div>                           
                        </div>                       
                        <div class="row" id="det01">                           
                            <div class="col-sm-8" >Rut-Tit : {{$resp->rutcli}}-{{$resp->dvcli}}</div>
                        </div>
                        <div class="row" id="det01">
                            <div class="col-sm-8" >Operador Evaluado: {{$resp->opereva}}</div>                           
                        </div> 
                        <div class="row" id="det01">  
                            <div class="col-sm-12" >Fecha Venta : {{date('d-m-Y', strtotime($resp->fvta))}}   / Fecha Asig: {{date('d-m-Y', strtotime($resp->fgrab))}}  / Fecha Audit: {{date('d-m-Y', strtotime($resp->created_at))}}  </div> 
                        </div>
                        <div class="row" id="det01">  
                            <div class="col-sm-12" >Id Grab :  {{$resp->idGrab}}  </div> 
                        </div>
                        <div class="row" id="det01">  
                            <div class="col-sm-12" >Periodo: {{$resp->mes}}-{{$resp->anio}}</div> 
                        </div>                  
                        <table class="table table-hover" id="tb01">
                            <thead>
                                <th data-field="name" data-sortable="true">Present (A)</th>
                                <th data-field="name" data-sortable="true">Cob crg(B)</th>
                                <th data-field="name" data-sortable="true">Previo (C)</th>
                                <th data-field="name" data-sortable="true">Datos (D)</th>  
                                <th data-field="name" data-sortable="true">Contrat (E)</th> 
                                <th data-field="name" data-sortable="true">Inf Vta(F)</th> 
                                <th data-field="name" data-sortable="true">Inf Cua(G)</th> 
                                <th data-field="name" data-sortable="true">Parcial</th>
                                <th data-field="name" data-sortable="true">Final</th>                                                                                                                                                                
                            </thead>
                            <tbody>                                                                                                                                  
                                <tr>                                   
                                    <td>{!! $resp->PrgA !!} %</td>  
                                    <td>{!! $resp->PrgB !!} %</td> 
                                    <td>{!! $resp->PrgC !!} %</td> 
                                    <td>{!! $resp->PrgD !!} %</td> 
                                    <td>{!! $resp->PrgE !!} %</td> 
                                    <td>{!! $resp->PrgF !!} %</td> 
                                    <td>{!! $resp->PrgG !!} %</td> 
                                    <td>{!! $resp->npartial !!} %</td> 
                                    <td>{!! $resp->nfinal !!} %</td>                                                                                                                      
                                </tr>                                  
                            </tbody>
                        </table>  
                        <hr>
                        <div class="row" id="det01">
                            <div class="col-sm-8" >Observaciones : {{$resp->observ}} </div>                           
                        </div>
                        <hr>                                    
                    </div>
                    <div class="modal-footer">
                    <a href="{{ route('alertmail',array('idx' =>$resp->id)) }}" class="btn btn-warning" ><i class="fa fa-envelope" aria-hidden="true"></i>e-mail</a>  
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>             
                    </div>
                </div>
            </div>
        </div>     
    @endforeach
    <!-- mail  -->
    @foreach($auditadas as $resp)
        <div class="modal fade bd-example-modal-lg" id="MailModal-{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($resp->Estado == "ALERTA")
                            <h5  id="tit01" class="modal-title" id="myModalLabel" style="color:red;"> Detalle de Evaluacion #  {{$resp->id}} / Estado: {{$resp->Estado}} </h5>
                        @else               
                            <h5  id="tit01" class="modal-title" id="myModalLabel"> Detalle de Evaluacion #  {{$resp->id}} / Estado: {{$resp->Estado}} </h5>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                  
                    </div>            
                    <div class="modal-body">   
                        <hr> 
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Observaciones</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="observ"></textarea>
                    </div>   
                    </div>
                    <div class="modal-footer">
                    <a href="{{ route('alertmail',array('idx' =>$resp->id)) }}" class="btn btn-warning" ><i class="fa fa-envelope" aria-hidden="true"></i>e-mail</a>  
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>             
                    </div>
                </div>
            </div>
        </div>     
    @endforeach
@endsection
@endauth

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- BUSQUEDA  -->
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                _this = this;
                $.each($("#tb01 tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });
        });
    </script>


<script>

function eliminarArticulo(id) {  
        swal({
            title: "Estas Seguro de Borrar el registro?",
            text: "Evaluacion de Ventas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Borrar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {             
              swal("Borrado", "Tu Registro fue Borrado.", "success");
                    var params = {"_token": "{{ csrf_token() }}",
                    "id" : id};      
                $.ajax({    
                    url: "{{route('delereg')}}", 
                    type: 'post',
                    data: params,
                    dataType: 'json',  
                    success: function(reg) {               
                        // top.location.href = 'https://localhost/ddavimo_v12/public/Audit'
                        window.location.href = "{{URL::to('Audit')}}"
                    }
                });
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }


</script>





<script>

    function eliminarArticuloXXXXX(id) {
        var params = {"_token": "{{ csrf_token() }}",
        "id" : id};      
        $.ajax({    
            url: "{{route('delereg')}}", 
            type: 'post',
            data: params,
            dataType: 'json',  
            success: function(reg) {               
                // top.location.href = 'https://localhost/ddavimo_v12/public/Audit'
                window.location.href = "{{URL::to('Audit')}}"
            }
        });
    }
</script>















<style>
    #del {
        border: none;text-align: center;
        padding:0px;
        color: red; 
        background-color: Transparent;
        cursor: pointer;
    }

    table td {
        font-size:10px;
    }

    .modal-backdrop {
    z-index: -1;
    }

    #divest {
        width: 50%;
    }

    #botn {
        display:inline;       
    }

    #bqrut {
        display:flex; 
        margin-right: 5px;
	float: right;
    }
</style>
