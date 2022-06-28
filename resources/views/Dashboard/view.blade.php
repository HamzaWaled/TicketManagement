@extends('layout.master')
@section('content')
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble img-circle elevation-5" style="opacity: .8"src="../../../../../../dist/img/alias.png" alt="TicketManagment" height="200" width="200">
  </div>


<link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/datedropper.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/datedropper.js"></script>


@if(Auth::user()->Category==1)
 <div class="content-wrapper">
    <br>

    <!-- search bar -->
    <form action="{{route('dash_search')}}" method="POST">
      <!-- this form will bring us to the search route, and the data that will be filled here will be returned to the controller (request $req) -->
      @csrf
        <section class="content">
              <div class="container mt-100">
                  <div class="card">
                      <div class="row">
                          <div class="col-md-4"> <label>De</label> <input type="date" name="fdate" required class="form-control" value="{{$datef}}"> </div>
                          <div class="col-md-4"> <label>À</label> <input type="date" name="ldate" required class="form-control" value="{{$datel}}"> </div>
                          <div class="col-md-4"> <label>Rechercher </label> <button class="btn btn-primary    w-100"><i class="fas fa-search"></i> </button> </div>
                      </div>
                  </div>
              </div>
        </section>
    <!-- Ps: the form is closed at the end in order to affect every thing when we change the date -->
    <!-- End search bar -->


<!-- /Create another card -->
        <section class="content">
      <div class="container-fluid">
        
       <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Rapport de Ticket</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
             
              <!-- /.card-header -->

              <div class="card-body">
                <div class="row">
                  
                  <!-- /.col -->
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Les tickets </strong>
                    </p>
                    
                    
                    
                    
<!-- Affected progress bar-->
                    <div class="progress-group">
                      Les Tickets affectés 
                      <span class="float-right">
                          @php
                        $counter3=0;
                        $WidthCalc3=0;
                        @endphp
                      @foreach($Tickets as $ticket)
                        @if($ticket->status == "Affected")
                          @php
                            $counter3++;
                          @endphp
                        @endif
                      @endforeach
                        @php
                        if($CountTickets!=0)
                            $WidthCalc3=($counter3/$CountTickets)*100;
                        @endphp
                        {{$counter3}}<b>/{{$CountTickets}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: {{$WidthCalc3}}%"></div>
                      </div>
                    </div>
                    <!-- End Affected progress bar-->
                    <!-- /Pending progress bar -->
                      <div class="progress-group">
                      Les Tickets en attente
                      <span class="float-right">
                        @php
                        $counter2=0;
                        $WidthCalc2=0;
                        @endphp
                      @foreach($Tickets as $ticket)
                        @if($ticket->status == "Pending")
                          @php
                            $counter2++;
                          @endphp
                        @endif
                      @endforeach
                      @php
                      if($CountTickets!=0)
                      $WidthCalc2=($counter2/$CountTickets)*100;
                      @endphp
                        {{$counter2}}<b>/{{$CountTickets}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: {{$WidthCalc2}}%"></div>
                      </div>
                    </div>
                    <!-- End Pending progress bar -->
                    <!-- Closed progress bar-->
                    <div class="progress-group">
                      Les Tickets clôturés
                      <span class="float-right">
                         @php
                        $counter1=0;
                        $WidthCalc=0;
                        @endphp
                      @foreach($Tickets as $ticket)
                        @if($ticket->status == "Closed")
                          @php
                            $counter1++;
                          @endphp
                        @endif
                      @endforeach
                      @php
                      if($CountTickets!=0)
                      $WidthCalc=($counter1/$CountTickets)*100;
                      @endphp
                      
                      {{$counter1}}<b>/{{$CountTickets}}</b></span>
                      <div class="progress progress-sm">
                        <!-- this is to calculate the width of the progress bar -->
                         <div class="progress-bar bg-success" style="width: {{$WidthCalc}}%"></div>
                      </div>
                    </div>
                    <!-- End Closed progress bar-->
                    

                    <!-- /Total number progress bar-->
                    <div class="progress-group">
                      Total des tickets
                      <span class="float-right">{{$CountTickets}}<b>/{{$CountTickets}}</b></span>
                      @php
                      $WidthCalc4=0;
                      if($CountTickets!=0)
                      $WidthCalc4=($CountTickets/$CountTickets)*100;
                      @endphp
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: {{$WidthCalc4}}%"></div>
                      </div>

                    </div>
                    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#Dashboard">
                                              
                        détails
                    </a>
                  </div>
                  
                </div>
                
              </div>
              
            
            </div>
            <!-- /.card -->
          </div>

          <!-- /.col -->
        </div>

        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
           
            <!-- /.card -->
            <div class="row">
              <div class="col-md-6">
               
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <!-- USERS LIST -->
                
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
      
        
        </div>
        <!-- /.row -->
      </div>
    </section>
<!-- /end of this card -->    


    <!-- /Create another card -->
    <div class="col-md-12">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Les 5 meilleurs agents</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  
                  </li>
                  @php
                    $count=0;
                  @endphp  

                  @foreach($top5agents as $Agent)
                    @php
                    $count++;
                    @endphp
                       <li class="item">
                          <div class="product-img">
                            <img src="../../../../../../dist/img/loginPic.jpg" alt="Product Image" class="img-size-50">
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">{{$Agent->FirstName}} {{$Agent->LastName}}

                              <span class="badge badge-success float-right">{{$Agent->total}}Tickets</span></a>
                              <p>AGENT N°{{$count}}</p>
                          </div>
                        </li>
                  @endforeach
                </ul>
              </div>
              <!-- /.card-body -->
              
        </div>
    </div>

  </div>

  



 <!-- /.modal details -->

      <div class="modal fade" id="Dashboard">
        <!-- the above div mean that we have a ticket named Affect2 with a specific id which is ticket['id']
       ticket['id'] is coming from foreach($displaying as $ticket) in line 144 which is a variable from type ticket(model) -->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détails des Tickets </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <table class="table table-bordered table-striped">
                




    <tr>
                    <th><h4 style="display: inline-block;">Ticket affecté </h4> <div class="circle1" style="display: inline-block;"></div></th>
                    <th><h4>Ticket en attente  <div class="circle2"></div></h4></th>
                    <th><h4>Ticket clôturé <div class="circle3"></div></h4></th>
                    
                </tr>

               
                      <tr>
                        <input type="hidden" class="sedelete_val" value="">
                        
                        <td>
                           @foreach($Tickets as $ticket)
                            @if($ticket->status =="Affected")
                              @foreach($user as $use)
                                    @if($ticket->id_user == $use->id)
                                   -Nom du client: {{$use->FirstName}} {{$use->LastName}}.<!-- ==>{{$ticket->Title}} -->
                                    <br>
                                    @endif 
                              @endforeach
                            @endif
                          @endforeach
                        </td>
                        <td>
                           @foreach($Tickets as $ticket)
                            @if($ticket->status =="Pending")
                              @foreach($user as $use)
                                    @if($ticket->id_user == $use->id)
                                   -Nom du client: {{$use->FirstName}} {{$use->LastName}}.<!-- ==>{{$ticket->Title}} -->
                                    <br>
                                    @endif 
                              @endforeach
                            @endif
                          @endforeach
                        </td>
                        <td>
                            @foreach($Tickets as $ticket)
                            @if($ticket->status =="Closed")
                              @foreach($user as $use)
                                    @if($ticket->id_user == $use->id)
                                   -Nom du client: {{$use->FirstName}} {{$use->LastName}}.<!-- ==>{{$ticket->Title}} -->
                                    <br>
                                    @endif 
                              @endforeach
                            @endif
                          @endforeach
                        </td>
                        
                      </tr>
                      
              </table>

        </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</form>

  <!-- /.end Model details -->
@endif

@if(Auth::user()->Category==2)



<div class="content-wrapper">
    <br>

    <!-- search bar -->
    <form action="{{route('dash_search')}}" method="POST">
      <!-- this form will bring us to the search route, and the data that will be filled here will be returned to the controller (request $req) -->

      @csrf
        <section class="content">
              <div class="container mt-100">
                  <div class="card">
                      <div class="row">
                          <div class="col-md-4"> <label>De</label> <input type="date" name="fdate" required class="form-control" value="{{$datef}}"> </div>
                          <div class="col-md-4"> <label>à</label> <input type="date" name="ldate" required class="form-control" value="{{$datel}}"> </div>
                          <div class="col-md-4"> <label>Rechercher</label> <button class="btn btn-primary pro-button w-100"><i class="fas fa-search"></i></button> </div>
                      </div>
                  </div>
              </div>
        </section>
    <!-- Ps: the form is closed at the end in order to affect every thing when we change the date -->
    <!-- End search bar -->
          @php
            $CountTickets=0;
          @endphp
@foreach($Tickets as $ticket)
          
      @if(Auth::user()->id==$ticket['id_user'])
         @php
          $CountTickets++;
          @endphp
      @endif
      @endforeach
<!-- /Create another card -->
        <section class="content">
      <div class="container-fluid">
        
       <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Rapport de Ticket</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
             
              <!-- /.card-header -->

              <div class="card-body">
                <div class="row">
                  
                  <!-- /.col -->
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Mes Tickets</strong>
                    </p>
                    
                    
                    
                    

                    <!-- /Pending progress bar -->
                      <div class="progress-group">
                      les Tickets en attente 
                      <span class="float-right">
                        @php
                        $counter2=0;
                        $WidthCalc2=0;
                        @endphp
                      @foreach($Tickets as $ticket)
                      @if(Auth::user()->id==$ticket['id_user'])
                        @if($ticket->status == "Pending" || $ticket->status == "Affected")
                          @php
                            $counter2++;
                          @endphp
                        @endif
                      @endif
                      @endforeach
                      @php
                      if($CountTickets!=0)
                      $WidthCalc2=($counter2/$CountTickets)*100;
                      @endphp
                        {{$counter2}}<b>/{{$CountTickets}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: {{$WidthCalc2}}%"></div>
                      </div>
                    </div>
                    <!-- End Pending progress bar -->
                    <!-- Closed progress bar-->
                    <div class="progress-group">
                      Les Tickets clôturés
                      <span class="float-right">
                         @php
                        $counter1=0;
                        $WidthCalc=0;
                        @endphp
                      @foreach($Tickets as $ticket)
                        @if(Auth::user()->id==$ticket['id_user'])
                            @if($ticket->status == "Closed")
                              @php
                                $counter1++;
                              @endphp
                            @endif
                        @endif
                      @endforeach
                      @php
                      if($CountTickets!=0)
                      $WidthCalc=($counter1/$CountTickets)*100;
                      @endphp
                      
                      {{$counter1}}<b>/{{$CountTickets}}</b></span>
                      <div class="progress progress-sm">
                        <!-- this is to calculate the width of the progress bar -->
                         <div class="progress-bar bg-success" style="width: {{$WidthCalc}}%"></div>
                      </div>
                    </div>
                    <!-- End Closed progress bar-->
                    <!-- Affected progress bar-->
                    <!-- no need to sho ffected to user -->
                    <!-- End Affected progress bar-->

                    <!-- /Total number progress bar-->
                    <div class="progress-group">
                      Total des Tickets
                      <span class="float-right">{{$CountTickets}}<b>/{{$CountTickets}}</b></span>
                      @php
                      $WidthCalc4=0;
                      if($CountTickets!=0)
                      $WidthCalc4=($CountTickets/$CountTickets)*100;
                      @endphp
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: {{$WidthCalc4}}%"></div>
                      </div>

                    </div>
                    @if(Auth::user()->Category==1)
                      <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#Dash">
                                                
                          détails
                      </a>
                    @endif
                  </div>
                  
                </div>
                
              </div>
              
            
            </div>
            <!-- /.card -->
          </div>

          <!-- /.col -->
        </div>

        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
           
            <!-- /.card -->
            <div class="row">
              <div class="col-md-6">
               
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <!-- USERS LIST -->
                
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
      
        
        </div>
        <!-- /.row -->
      </div>
    </section>
<!-- /end of this card -->    


    <!-- /Create another card -->
   

  </div>



 <!-- /.modal details -->

      <div class="modal fade" id="Dash">
        <!-- the above div mean that we have a ticket named Affect2 with a specific id which is ticket['id']
       ticket['id'] is coming from foreach($displaying as $ticket) in line 144 which is a variable from type ticket(model) -->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détails des Tickets</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <table class="table table-bordered table-striped">
                <tr>
                    <th><h4 style="display: inline-block;"> Les tickets affectés </h4> <div class="circle1" style="display: inline-block;"></div></th>
                    <th><h4>Les tickets en attente <div class="circle2"></div></h4></th>
                    <th><h4>Les tickets clôturés<div class="circle3"></div></h4></th>
                    
                </tr>

               
                      <tr>
                        <input type="hidden" class="sedelete_val" value="">
                        
                        <td>
                          @foreach($Tickets as $ticket)
                          @if(Auth::user()->id==$ticket['id_user'])
                            @if($ticket->status =="Affected")
                              -{{$ticket->Title}}
                              <br>
                          @endif 
                            @endif 
                          @endforeach
                        </td>
                        <td>
                          @foreach($Tickets as $ticket)
                          @if(Auth::user()->id==$ticket['id_user'])
                            @if($ticket->status =="Pending")
                             -{{$ticket->Title}}
                              <br>
                            @endif
                             @endif 

                          @endforeach
                        </td>
                        <td>
                           @foreach($Tickets as $ticket)
                           @if(Auth::user()->id==$ticket['id_user'])
                            @if($ticket->status =="Closed")
                              -{{$ticket->Title}}
                              <br>
                            @endif 
                            @endif 

                          @endforeach
                        </td>
                        
                      </tr>
                      
              </table>

        </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</form>

  <!-- /.end Model details -->
@endif


<!-- agent dashboard  -->

@if(Auth::user()->Category==3)



<div class="content-wrapper">
    <br>

    <!-- search bar -->
    <form action="{{route('dash_search')}}" method="POST">
      <!-- this form will bring us to the search route, and the data that will be filled here will be returned to the controller (request $req) -->

      @csrf
        <section class="content">
              <div class="container mt-100">
                  <div class="card">
                      <div class="row">
                          <div class="col-md-4"> <label>De</label> <input type="date" name="fdate" required class="form-control" value="{{$datef}}"> </div>
                          <div class="col-md-4"> <label>à</label> <input type="date" name="ldate" required class="form-control" value="{{$datel}}"> </div>
                          <div class="col-md-4"> <label>Rechercher</label> <button class="btn btn-primary pro-button w-100"><i class="fas fa-search"></i></button> </div>
                      </div>
                  </div>
              </div>
        </section>
    <!-- Ps: the form is closed at the end in order to affect every thing when we change the date -->
    <!-- End search bar -->
          @php
            $CountTickets=0;
          @endphp
@foreach($Tickets as $ticket)
          
      @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->id==$ticket['AffectedId'] )
         @php
          $CountTickets++;
          @endphp
      @endif
      @endforeach
<!-- /Create another card -->
        <section class="content">

      <div class="container-fluid">
        
       <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Rapport de Ticket</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
             
              <!-- /.card-header -->

              <div class="card-body">
                <div class="row">
                  
                  <!-- /.col -->
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Mes Tickets</strong>
                    </p>
                    
                    
                    
                    

                    <!-- /Pending progress bar -->
                      <div class="progress-group">
                      les Tickets en attente 
                      <span class="float-right">
                        @php
                        $counter2=0;
                        $WidthCalc2=0;
                        @endphp
                      @foreach($Tickets as $ticket)
                      @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->id==$ticket['AffectedId'])
                        @if($ticket->status == "Pending" || $ticket->status == "Affected")
                          @php
                            $counter2++;
                          @endphp
                        @endif
                      @endif
                      @endforeach
                      @php
                      if($CountTickets!=0)
                      $WidthCalc2=($counter2/$CountTickets)*100;
                      @endphp
                        {{$counter2}}<b>/{{$CountTickets}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: {{$WidthCalc2}}%"></div>
                      </div>
                    </div>
                    <!-- End Pending progress bar -->

                    <!-- Affected progress bar-->
                    <!-- no need to sho ffected to user -->
                    <!-- End Affected progress bar-->
<!-- Closed progress bar-->
                    <div class="progress-group">
                      Les Tickets clôturés
                      <span class="float-right">
                         @php
                        $counter1=0;
                        $WidthCalc=0;
                        @endphp
                      @foreach($Tickets as $ticket)
                        @if(Auth::user()->id==$ticket['id_user']|| Auth::user()->id==$ticket['AffectedId'])
                            @if($ticket->status == "Closed")
                              @php
                                $counter1++;
                              @endphp
                            @endif
                        @endif
                      @endforeach
                      @php
                      if($CountTickets!=0)
                      $WidthCalc=($counter1/$CountTickets)*100;
                      @endphp
                      
                      {{$counter1}}<b>/{{$CountTickets}}</b></span>
                      <div class="progress progress-sm">
                        <!-- this is to calculate the width of the progress bar -->
                         <div class="progress-bar bg-success" style="width: {{$WidthCalc}}%"></div>
                      </div>
                    </div>
                    <!-- End Closed progress bar-->
                    <!-- /Total number progress bar-->
                    <div class="progress-group">
                      Total des Tickets
                      <span class="float-right">{{$CountTickets}}<b>/{{$CountTickets}}</b></span>
                      @php
                      $WidthCalc4=0;
                      if($CountTickets!=0)
                      $WidthCalc4=($CountTickets/$CountTickets)*100;
                      @endphp
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: {{$WidthCalc4}}%"></div>
                      </div>

                    </div>
                    @if(Auth::user()->Category==1)
                      <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#Dash">
                                                
                          détails
                      </a>
                    @endif
                  </div>
                  
                </div>
                
              </div>
              
            
            </div>
            <!-- /.card -->
          </div>

          <!-- /.col -->
        </div>

        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
           
            <!-- /.card -->
            <div class="row">
              <div class="col-md-6">
               
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <!-- USERS LIST -->
                
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
      
        
        </div>
        <!-- /.row -->
      </div>
    </section>
<!-- /end of this card -->    


    <!-- /Create another card -->
   

  </div>



 <!-- /.modal details -->

      <div class="modal fade" id="Dash">
        <!-- the above div mean that we have a ticket named Affect2 with a specific id which is ticket['id']
       ticket['id'] is coming from foreach($displaying as $ticket) in line 144 which is a variable from type ticket(model) -->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détails des Tickets</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <table class="table table-bordered table-striped">
                <tr>
                    <th><h4 style="display: inline-block;"> Les tickets affectés </h4> <div class="circle1" style="display: inline-block;"></div></th>
                    <th><h4>Les tickets en attente <div class="circle2"></div></h4></th>
                    <th><h4>Les tickets clôturés<div class="circle3"></div></h4></th>
                    
                </tr>

               
                      <tr>
                        <input type="hidden" class="sedelete_val" value="">
                        
                        <td>
                          @foreach($Tickets as $ticket)
                          @if(Auth::user()->id==$ticket['id_user'])
                            @if($ticket->status =="Affected")
                              -Problème: {{$ticket->Title}}
                              <br>
                          @endif 
                            @endif 
                          @endforeach
                        </td>
                        <td>
                          @foreach($Tickets as $ticket)
                          @if(Auth::user()->id==$ticket['id_user'])
                            @if($ticket->status =="Pending")
                             -Problème: {{$ticket->Title}}
                              <br>
                            @endif
                             @endif 

                          @endforeach
                        </td>
                        <td>
                           @foreach($Tickets as $ticket)
                           @if(Auth::user()->id==$ticket['id_user'])
                            @if($ticket->status =="Closed")
                              -Problème: {{$ticket->Title}}
                              <br>
                            @endif 
                            @endif 

                          @endforeach
                        </td>
                        
                      </tr>
                      
              </table>

        </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</form>

  <!-- /.end Model details -->
@endif
<!-- end agent dashboard -->
</div>
<style>
.circle1 {
  height: 20px;
  width: 20px;
  background-color: #5cb8d6;
  border-radius: 50%;
  float: right;
}
.circle2 {
  height: 20px;
  width: 20px;
  background-color: #ffcc00;
  border-radius: 50%;
   float: right;
}
.circle3 {
  height: 20px;
  width: 20px;
  background-color: #339900;
  border-radius: 50%;
   float: right;
}
<style>
  
  @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

html,
body {
    height: 100%
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    padding: 20px;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border-radius: 6px;
    -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1)
}

.form-control[readonly] {
    background-color: #f44336;
    opacity: 1;
    color: #fff;
    border: 1px solid #f44336
}

.pro-button {
    background-color: #f44336;
    border-color: #f44336
}

.pro-button:focus {
    outline: none !important;
    background-color: #f44336;
    border-color: #f44336;
    box-shadow: 0 0 0 0.2rem rgb(255, 255, 255) !important
}

.pro-button:active {
    outline: none !important;
    background-color: #f44336 !important;
    border-color: #f44336 !important
}

.pro-button:hover {
    background-color: #d8271a;
    border-color: #d8271a
}

label {
    font-weight: 800
}
</style>
@endsection
@section('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel"]
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


@endsection
