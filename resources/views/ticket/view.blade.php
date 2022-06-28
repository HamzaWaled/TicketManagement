@extends('layout.master')
@section('content')
 <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            
          </section>

          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="card card-default">
                <div class="card-header">
                  <h2 class="card-title">La liste des tickets </h2>
                  
                    <div class="page-content page-container" id="page-content">
                          <div class="ADD_btn">
                              <button  type="button" class="btn btn-primary btn-sm"><a style="color: white; " href="/FillTicketForm" class="nav-link"><i class="fas fa-plus"></i> Ajouter un ticket </a></button>
                          </div>
                      </div>
               </div>
                
                <!-- /.card-header -->
               <div >
               
          @if(Auth::user()->Category==1)
              <div class="tbl">
                <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color:#f2f2f2; color: Black;  text-align: center;">
                  <tr>
                    <th><h4>Statut</h4></th>
                    <th ><h4>
                    Société</h4></th>
                    <th><h4>Objet</h4></th>

                    <th><h4>Catégorie 
                    <th><h4>Description</h4></th>
                    
                    <th><h4>Créé à</h4></th>
                    <th><h4>Affecté à</h4></th>
                    <th><h4>Action</h4></th>
                  </tr>
                  </thead>
                  <!-- display is the variable where we have stored data in usercontroller and User is the model -->
                  @foreach($displaying as $ticket)
                   <tr>
                    @if($ticket['status'] == "Pending")
                    <td> <span class="badge badge-warning"> En attente</span>
                      @if($ticket['Share_flag'] == "1")
                          <br> <i class="fas fa-paper-plane"></i><span class="badge "> Partagé</span>
                      @endif
                    </td>
                    
                    @elseif($ticket['status'] == "Affected")
                    <td> <span class="badge badge-info"> Affecté</span>
                         @if($ticket['Share_flag'] == "1")
                         <br> <i class="fas fa-paper-plane"></i><span class="badge "> Partagé</span>
                          @endif

                    </td>
                    
                     @elseif($ticket['status'] == "Closed")
                    <td><span class="badge badge-success"> clôturé</span>
                         @if($ticket['Share_flag'] == "1")
                           <br><i class="fas fa-paper-plane"></i><span class="badge "> Partagé</span>
                      @endif

                    </td>
                    @endif 
                    <td >
                      
                      @foreach($societies as $soci)
                        @if($ticket['Society']==$soci->id)
                        {{ $soci->SocietyName }}
                        @endisset

                         
                      @endforeach
                    </td>
                    <td>{{$ticket['Title']}} </td>
                    <td>
                    
                    @foreach ($categories as $categorie)
                          @if($categorie->id==$ticket['Cat'])

                          {{ $categorie->CategoryName }}

                          @endif
                    @endforeach
                   
                    </td>
                    <td>
                      {!! Str::limit($ticket['Problem'], 30, $end='...') !!}
                      <a style="float: right; color: black;" class="badge " data-toggle="modal" data-target="#Problem{{$ticket['id']}}">
                                        <i class="fas fa-book"></i>

                                              
                                        </a>
                    </td>
                    
                    
                    <td>
                      {{ \Carbon\Carbon::parse($ticket['created_at'])->format('d.m.Y - H:i')}}
                    </td>
                    <td> @foreach($da as $Take_user)
                      <!-- $da is from type User, we need to check that the id inside $Take_user that is from type $da equal to the ticket affected, and display the name that is inside $Take_user 
                        Ps: inside $ticket['AffectedId'] there is the id of the user who was assigned to take a specific ticket-->
                                  @if($ticket['AffectedId'] == $Take_user['id'])
                                    {{$Take_user->FirstName}} {{$Take_user->LastName}}

                                  @elseif($ticket['AffectedId'] == null)  
                                  <?php echo ("Personne n'est affecté");  break;?>

                                  @endif

                              @endforeach

                    

                      

                    </td>
                    

                    <td>
                      <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->Category==1)
                                  <!-- Auth::user()->id==$ticket['id_user']’ Which means if the user who have created the ticket is the one who is logging in, and the ticket is not affected to anyone, ($ticket['AffectedId']==null) , so we can delete the ticket, otherwise we won’t be able to delete that ticket    -->
                                    @if($ticket['AffectedId']==null && $ticket['status']!="Closed")
                                    <a class="dropdown-item" href="{{route('ticket.edit',['id'=>$ticket['id']])}}">Éditer</a>
                                    <a class="dropdown-item" type="button" onclick="return REMOVE('{{route('ticket.delete',['id'=>$ticket['id']])}}')" class="servideletebtn">
                                    <!-- here we define that the Id IS THE ID OF THE TICKET  -->
                                    Supprimer
                                    </a>
                                  @endif

                                  @endif

                                  @if($ticket['status']!="Closed")
                                    <a class="dropdown-item" href="{{route('ticket.show',['id'=>$ticket['id']])}}">Répondre</a>
                                  @endif
     
                                  @if(Auth::user()->Category!=2)
                                  <!-- affect is only accessible b the agent (he can re affed, or the Admin he can affect) -->
                                  
                                    @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->Category==1 || Auth::user()->Category==3)

                                    <!-- the person can't affect a ticket to himself and you can't affect a ticket if you are the one who have created this ticket except if you are the admin AFFECTED OR AGENT  -->
                                      @if($ticket['status']!="Closed")
                                            <a class="dropdown-item" data-toggle="modal" data-target="#Affect{{$ticket['id']}}">
                                              <!-- #Affect{{$ticket['id']}} is linking the id of the ticket with the affect pop up -->
                                              Affecter
                                            </a>
                                            <a class="dropdown-item" href="{{route('ticket.share',['id'=>$ticket['id']])}}">
                                              <!-- this will be shred with every agent -->
                                              Partager
                                            </a>
                                      @endif
                                    @endif

                                  @endif
                                   @if(Auth::user()->Category==1)
                                   <!-- only Admin can see the historys -->
                                        <a class="dropdown-item" data-toggle="modal" data-target="#History{{$ticket['id']}}">
                                          Historique
                                          </a>
                                    @endif
                                  
                                    <a class="dropdown-item" href="{{route('History.rep',['id'=>$ticket['id']])}}">
                                          Détails
                                        </a>
                                </div>

                          </div>


                    </td>

                </tr>
                  @endforeach
                  
                    
                  
                </table>
          @endif  
          @if(Auth::user()->Category==3)
              <div class="tbl">
                <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color:#f2f2f2; color: Black;  text-align: center;">
                  <tr>
                    <th><h4>Statut</h4></th>
                    <th ><h4>
                    Société</h4></th>
                    <th><h4>Objet</h4></th>

                    <th><h4>Catégorie 
                    <th><h4>Description</h4></th>
                    
                    <th><h4>Créé à</h4></th>
                    
                    <th><h4>Action</h4></th>
                  </tr>
                  </thead>
                  <!-- display is the variable where we have stored data in usercontroller and User is the model -->
                  @foreach($displaying as $ticket)
                   <tr>
                    @if($ticket['status'] == "Pending")
                    <td> <span class="badge badge-warning"> En attente</span>
                      @if($ticket['Share_flag'] == "1")
                          <br> <i class="fas fa-paper-plane"></i><span class="badge "> Partagé</span>
                      @endif
                    </td>
                    
                    @elseif($ticket['status'] == "Affected")
                    <td> <span class="badge badge-info"> Affecté</span>
                         @if($ticket['Share_flag'] == "1")
                         <br> <i class="fas fa-paper-plane"></i><span class="badge "> Partagé</span>
                          @endif

                    </td>
                    
                     @elseif($ticket['status'] == "Closed")
                    <td><span class="badge badge-success"> clôturé</span>
                         @if($ticket['Share_flag'] == "1")
                           <br><i class="fas fa-paper-plane"></i><span class="badge "> Partagé</span>
                      @endif

                    </td>
                    @endif 
                    <td >
                      
                      @foreach($societies as $soci)
                        @if($ticket['Society']==$soci->id)
                        {{ $soci->SocietyName }}
                        @endisset

                         
                      @endforeach
                    </td>
                    <td>{{$ticket['Title']}} </td>
                    <td>
                    
                    @foreach ($categories as $categorie)
                          @if($categorie->id==$ticket['Cat'])

                          {{ $categorie->CategoryName }}

                          @endif
                    @endforeach
                   
                    </td>
                    <td>
                      {!! Str::limit($ticket['Problem'], 30, $end='...') !!}
                      <a style="float: right; color: black;" class="badge " data-toggle="modal" data-target="#Problem{{$ticket['id']}}">
                                        <i class="fas fa-book"></i>

                                              
                                        </a>
                    </td>
                    
                    
                    <td>
                      {{ \Carbon\Carbon::parse($ticket['created_at'])->format('d.m.Y - H:i')}}
                    </td>
                    
                    

                    <td>
                      <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #5cb8d6;">
                                  Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->Category==1)
                                  <!-- Auth::user()->id==$ticket['id_user']’ Which means if the user who have created the ticket is the one who is logging in, and the ticket is not affected to anyone, ($ticket['AffectedId']==null) , so we can delete the ticket, otherwise we won’t be able to delete that ticket    -->
                                    @if($ticket['AffectedId']==null && $ticket['status']!="Closed")
                                    <a class="dropdown-item" href="{{route('ticket.edit',['id'=>$ticket['id']])}}">Éditer</a>
                                    <a class="dropdown-item" type="button" onclick="return REMOVE('{{route('ticket.delete',['id'=>$ticket['id']])}}')" class="servideletebtn">
                                    <!-- here we define that the Id IS THE ID OF THE TICKET  -->
                                    Supprimer
                                    </a>
                                  @endif

                                  @endif

                                  @if($ticket['status']!="Closed")
                                    <a class="dropdown-item" href="{{route('ticket.show',['id'=>$ticket['id']])}}">Répondre</a>
                                  @endif
     
                                  @if(Auth::user()->Category!=2)
                                  <!-- affect is only accessible b the agent (he can re affed, or the Admin he can affect) -->
                                  
                                    @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->Category==1 || Auth::user()->Category==3)

                                    <!-- the person can't affect a ticket to himself and you can't affect a ticket if you are the one who have created this ticket except if you are the admin AFFECTED OR AGENT  -->
                                      @if($ticket['status']!="Closed")
                                            <a class="dropdown-item" data-toggle="modal" data-target="#Affect{{$ticket['id']}}">
                                              <!-- #Affect{{$ticket['id']}} is linking the id of the ticket with the affect pop up -->
                                              Affecter
                                            </a>
                                            <a class="dropdown-item" href="{{route('ticket.share',['id'=>$ticket['id']])}}">
                                              <!-- this will be shred with every agent -->
                                              Partager
                                            </a>
                                      @endif
                                    @endif

                                  @endif
                                   @if(Auth::user()->Category==1 || Auth::user()->Category==3 )
                                   <!-- only Admin and the agent can see the historys -->
                                        <a class="dropdown-item" data-toggle="modal" data-target="#History{{$ticket['id']}}">
                                          Historique
                                          </a>
                                    @endif
                                  
                                    <a class="dropdown-item" href="{{route('History.rep',['id'=>$ticket['id']])}}">
                                          Détails
                                        </a>
                                </div>

                          </div>


                    </td>

                </tr>
                  @endforeach
                  
                    
                  
                </table>
          @endif  
           @if(Auth::user()->Category==2 )
              <div class="tbl">
                <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color:#f2f2f2; color: Black;  text-align: center;">
                  <tr>
                    <th><h4>Statut</h4></th>
                    
                    <th><h4>Objet </h4></th>

                    <th><h4>Catégorie 
                    <th><h4>Description</h4></th>
                    
                    <th><h4>Créé à</h4></th>
                    
                    <th><h4>Action</h4></th>
                  </tr>
                  </thead>
                  <!-- display is the variable where we have stored data in usercontroller and User is the model -->
                  @foreach($displaying as $ticket)
                   <tr>
                    @if($ticket['status'] == "Pending")
                    <td> <span class="badge badge-warning"> En attente</span></td>
                    
                    @elseif($ticket['status'] == "Affected")
                    <td> <span class="badge badge-warning"> En attente</span></td>
                    
                     @elseif($ticket['status'] == "Closed")
                    <td><span class="badge badge-success"> clôturé</span></td>
                    @endif 
                    
                    <td>{{$ticket['Title']}} </td>
                    <td>
                    
                    @foreach ($categories as $categorie)
                          @if($categorie->id==$ticket['Cat'])

                          {{ $categorie->CategoryName }}

                          @endif
                    @endforeach
                   
                    </td>
                    <td>
                      {!! Str::limit($ticket['Problem'], 30, $end='...') !!}
                      <a style="float: right; color: black;" class="badge" data-toggle="modal" data-target="#Problem{{$ticket['id']}}">
                                         <i class="fas fa-book"></i>

                                               
                                        </a>
                    </td>
                    
                    
                    <td>
                      {{ \Carbon\Carbon::parse($ticket['created_at'])->format('d.m.Y - H:i')}}
                    </td>
                    
                    

                    <td>
                      <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #5cb8d6;">
                                  Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->Category==1)
                                  <!-- Auth::user()->id==$ticket['id_user']’ Which means if the user who have created the ticket is the one who is logging in, and the ticket is not affected to anyone, ($ticket['AffectedId']==null) , so we can delete the ticket, otherwise we won’t be able to delete that ticket    -->
                                    @if($ticket['AffectedId']==null && $ticket['status']!="Closed")
                                    <a class="dropdown-item" href="{{route('ticket.edit',['id'=>$ticket['id']])}}">Éditer</a>
                                    <a class="dropdown-item" type="button" onclick="return REMOVE('{{route('ticket.delete',['id'=>$ticket['id']])}}')" class="servideletebtn">
                                    <!-- here we define that the Id IS THE ID OF THE TICKET  -->
                                    Supprimer
                                    </a>
                                  @endif

                                  @endif

                                  @if($ticket['status']!="Closed")
                                    <a class="dropdown-item" href="{{route('ticket.show',['id'=>$ticket['id']])}}">Répondre</a>
                                  @endif
     
                                  @if(Auth::user()->Category!=2)
                                  <!-- affect is only accessible b the agent (he can re affed, or the Admin he can affect) -->
                                  
                                    @if(Auth::user()->id==$ticket['id_user'] || Auth::user()->Category==1)

                                    <!-- the person can't affect a ticket to himself and you can't affect a ticket if you are the one who have created this ticket except if you are the admin  -->
                                      @if($ticket['status']!="Closed")
                                            <a class="dropdown-item" data-toggle="modal" data-target="#Affect{{$ticket['id']}}">
                                              <!-- #Affect{{$ticket['id']}} is linking the id of the ticket with the affect pop up -->
                                              Affecter
                                            </a>
                                            
                                      @endif
                                    @endif

                                  @endif
                                   @if(Auth::user()->Category==1)
                                   <!-- only Admin can see the historys -->
                                        <a class="dropdown-item" data-toggle="modal" data-target="#History{{$ticket['id']}}">
                                          Historique
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{route('History.rep',['id'=>$ticket['id']])}}">
                                          Détails
                                        </a>
                                  
                                </div>

                          </div>


                    </td>

                </tr>
                  @endforeach
                  
                  
                  
                </table>
          @endif    
<!-- /.modal effect -->
@foreach($displaying as $ticket)

      <div class="modal fade" id="Affect{{$ticket['id']}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Liste des agents</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <table class="table table-bordered table-striped">
                <tr>
                    <th><h4>Prénom</h4></th>
                    <th><h4>Nom de famille</h4></th>
                    <th><h4>Action</h4></th>
                </tr>

                @foreach($display as $User)
                  @if($ticket->AffectedId==null ) 
                  <!--we need to first check if the ticket is not affected to anyone, in that case we should display all the agents when we click on the affected button -->
                  <tr>
                    <input type="hidden" class="sedelete_val" value="{{$User['id']}}">
                    <td>{{$User['FirstName']}}</td>
                    <td>{{$User['LastName']}}</td>
                    <th><h4><a class="btn btn-success" href="{{route('affect_ticket',[
                      'id'=>$ticket['id'],'user'=>$User['id']
                      ])}}">Affecter</a>
                    </h4></th>
                  </tr>
                  @else
                    @if($ticket->AffectedId!=$User->id)
                    <!-- 
                    -$ticket->AffectedId is the id of the person who was affected by this specific ticket.
                    -$User->id is the id of every User.
                    ==> now we need to display only the agents who are not affected by this tickets. and the person who is affected by the ticket is the one who will satisfy the condition ($ticket->AffectedId==$User->id) this is why we should display thet users who do not satisfy this condition only.
                      -->
                  <tr>
                    <input type="hidden" class="sedelete_val" value="{{$User['id']}}">
                    <td>{{$User['FirstName']}}</td>
                    <td>{{$User['LastName']}}</td>
                    <th><h4><a class="btn btn-success" href="{{route('affect_ticket',[
                      'id'=>$ticket['id'],'user'=>$User['id']
                      ])}}">Affecter</a>
                    </h4></th>
                  </tr>

                    @endif


                  @endif

                  @endforeach
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
@endforeach

 <!-- end /.modal effect -->

  <!-- /.modal History -->
@foreach($displaying as $ticket)
      <div class="modal fade" id="History{{$ticket['id']}}">
        <!-- the above div mean that we have a ticket named Affect2 with a specific id which is {{$ticket['id']}}
       ticket['id'] is coming from foreach($displaying as $ticket) in line 144 which is a variable from type ticket(model) -->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">historique d'affection</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <table class="table table-bordered table-striped">
                <tr>
                    <th><h4>Affecté par</h4></th>
                    <th><h4>Affecté à</h4></th>
                    <th><h4> à</h4></th>
                    
                </tr>

                @foreach($History as $Hist_user)
                  @if($ticket['id']==$Hist_user->TicketId)
                  <!-- this is to display only the history of the ticket that we have selected
                  So we have to check $ticket['id'] which is ticket selected with -->
                      <tr>
                        <input type="hidden" class="sedelete_val" value="{{$User['id']}}">
                        
                        <td> 
                          @foreach($data3 as $use)
                          <!-- this is to display the names instead of the ids -->
                            @if($use['id'] == $Hist_user['id_user'])
                              {{$use['FirstName']}} {{$use['LastName']}}
                            @endif
                            @endforeach

                        </td>
                        <td>
                           @foreach($data3 as $use)
                           <!-- this is to display the names instead of the ids -->
                            @if($use['id'] == $Hist_user['AffectedId'])
                              {{$use['FirstName']}} {{$use['LastName']}}
                            @endif
                            @endforeach
                        
                      </td>
                        <td>{{$Hist_user['updated_at']}}</td>
                        
                      </tr>
                      @endif
                    

                @endforeach
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
@endforeach

  <!-- /.end Model History -->

   <!-- /.modal Problem description -->
@foreach($displaying as $ticket)
      <div class="modal fade" id="Problem{{$ticket['id']}}">
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détails du problème</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               
             {!!$ticket['Problem']!!}

        </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endforeach

  <!-- /.end Model Problem description -->

              </div>
            </div>

              </div>
          
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.content -->
        </div>
        <style>
            .ADD_btn{
            float: right;
            
            } 

        </style>
 
        <!-- /.content-wrapper -->
     @endsection
@section('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
       "buttons": [""]
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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

