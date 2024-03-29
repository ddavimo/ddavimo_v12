
@section('content')
@auth   
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
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
                                        <p class="card-category">CUMPLE</p>
                                        <h4 class="card-title" style="font-size;24px;">{{$lscumple}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"> 
                                </i>AUDITORIAS SATISFACTORIAS
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
                                        <h4 class="card-title" >{{$Countcli}}</h4>
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
            </div>
        </div>
    </div>   
    @if(Auth::user()->idtype  == 9)  
    @else
    <div class="row">  
        @if($lsdash>0)     
            @foreach($dashs as $valor =>$spk)
                <div class="col-lg-3 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-2">
                                    @if($valor%2 == 0)                                             
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-headphones-2 text-warning"></i>                                             
                                        </div>
                                    @else 
                                        <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-headphones-2 text-success"></i>                                             
                                        </div>
                                    @endif                                           
                                </div>
                                <div class="col-10">
                                    <div class="numbers">
                                    <p class="card-category">TOTAL: <span style="color:   #a8dcd7; font-size:18px ">{{$spk->cant}} </span> </p>
                                        <h3 class="card-title">  <small>Cumple:</small> {{$spk->cumple}} <small>:</small> {{round(($spk->cumple/$spk->cant)*100)}} <small>%</small> 
                                        <br> <small>Alertas:</small> {{$spk->alerta}} <small>:</small> {{round(($spk->alerta/$spk->cant)*100)}} <small>%</small>                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">                               
                                <p style="color:grey; font-size:14px"> {{$spk->name}} / <span style="color:   #a8dcd7  "> {{$spk->canal}} </span>  : {{$spk->partial}} %</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div> 
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Gestion de Auditorias</h4>
                    <p class="card-category"> Auditorias en Alertas</p>
                </div>
                <div class="card-body">                   
                    @if($auditCount > 0)        
                        <div class="card-body ">            
                            <table class="table table-hover" id="tb01">
                                <thead>
                                    <th data-field="name" data-sortable="true">Id</th>
                                    <th data-field="name" data-sortable="true">Sponsor</th>
                                    <th data-field="name" data-sortable="true">Canal</th>
                                    <th data-field="name" data-sortable="true">Campaña</th>
                                    <th data-field="name" data-sortable="true">Periodo</th> 
                                    <th data-field="name" data-sortable="true">Operador@</th>  
                                    <th data-field="name" data-sortable="true">Cliente</th> 
                                    <th data-field="name" data-sortable="true">Fecha</th>                                       
                                    <th data-field="name" data-sortable="true">%Pcl</th>
                                    <th data-field="name" data-sortable="true">%Final</th>                           
                                    <th data-field="name" data-sortable="true">Ejecutiv@</th>                              
                                    <th data-field="name" data-sortable="true">Alerta</th>                                                                                                      
                                </thead>
                                <tbody>
                                    @foreach($auditalert as $resp)                                                                                                                
                                        <tr>
                                            <td>{!! $resp->id !!}</td>  
                                            <td>{!! $resp->sname !!}</td>
                                            <td>{!! $resp->canal !!}</td>  
                                            <td>{!! $resp->campania !!}</td>  
                                            <td class="text-center">{!! $resp->mes !!}/{!! $resp->anio !!}</td>                                     
                                            @if($resp->nombre == "EJECUTIVO SIN PRESENTACION")
                                                <td style="color:red;">{!! $resp->nombre !!}</td> 
                                            @else 
                                                <td>{!! $resp->nombre !!}</td> 
                                            @endif
                                            <td>{!! $resp->rutcli !!}-{!! $resp->dvcli !!}</td>   
                                            <td>{!! date('d-m-Y', strtotime($resp->created_at)) !!}</td>                                                                  
                                            <td class="text-center">{!! $resp->npartial !!} %</td> 
                                            <td class="text-center">{!! $resp->nfinal !!} %</td>                                  
                                            <td class="text-left">{!! $resp->eje !!}</td>                                            
                                            @if($resp->alert == 1)   
                                            <td class="text-left">
                                                <a href="#PlaceModal-{{$resp->id}}" data-toggle="modal"><i class="fa fa-exclamation-triangle" aria-hidden="true" style=color:red;></i></a>
                                            </td> 
                                            @else
                                            <td class="text-left">
                                                <a href="#PlaceModal-{{$resp->id}}" data-toggle="modal"><i class="fa fa-search"></i></a>
                                            </td> 
                                            @endif 
                                         
                                        </tr>                                        
                                    @endforeach 
                                </tbody>                   
                            </table>  
                            <div class="pagination"> {{ $auditalert->appends($_GET)->links() }} </div>                                   
                        </div>                                  
                    @endif 
                </div>
            </div>
        </div>
    </div>      
    <!-- modal  -->
    @if($auditCount > 0)
        @foreach($auditalert as $resp)
            <div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            @if($resp->Estado == "ALERTA")
                                <h5  id="tit01" class="modal-title" id="myModalLabel" style="color:red;">Auditoria #  {{$resp->id}} / @if($resp->alert == 1): ALERTA CRITICA  <i class="fa fa-exclamation-triangle" aria-hidden="true" style=color:red;></i>@else Estado: {{$resp->Estado}} @endif  </h5>
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
                                <div class="col-sm-12" >Fecha Venta : {{date('d-m-Y', strtotime($resp->Fvta))}}</td>   / Fecha Asig: {{date('d-m-Y', strtotime($resp->Fgrab))}}  / Fecha Audit: {{date('d-m-Y', strtotime($resp->created_at))}}  </div> 
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
                            <div class="row" id="detobs">
                                <div class="col-sm-12" id="obs01">Observaciones : {{$resp->observ}} </div>                           
                            </div>
                            <hr>  
                            @if($resp->grabacion != null)
                                <div class="row" id="divgrab01">
                                    <div class="col-sm-12" id="grab01">Grabacion Alerta : <a href="{{ route('uploads',array('file' =>$resp->grabacion)) }}"> {{$resp->grabacion}}</a>  </div>              
                                </div>  
                                <hr>
                            @endif 
                           
                            @if($resp->Apelacion == 1) 
                            <div class="row" id="det01">
                                <div class="col-sm-12" style="color:red;">*** APELACION ***</div>                           
                            </div>    
                            @endif                   
                        </div>
                        <div class="modal-footer"> 
                            <a href="{{ route('editaudit',array('lid' =>$resp->id)) }}" class="btn btn-warning" ><i class="fa fa-comment" aria-hidden="true"></i>Comentar</a>                    
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>                          
                        </div>
                    </div>
                </div>
            </div>     
        @endforeach
    @endif
@endauth
@endsection

<style>
    #tb01 td,table th{
        font-size: 10px;
    }
    .modal  {
        font-size:11px;
    }
    #detobs { 
        white-space: nowrap;
        overflow: hidden;
    }
</style>