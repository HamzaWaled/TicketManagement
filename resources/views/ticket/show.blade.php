@extends('layout.master')
@section('content')



                                  <!-- this is reply page -->



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

          <!-- Content Header (Page header) -->
          <section class="content-header">
            

          </section>

          <!-- Main content -->
          <section class="content">

            <!-- Default box -->

            <div class="card card-default">
              <!-- Image and name -->

              <!-- Date of creating -->
              

              <!-- showing image -->
                <div class="card-header">
                  <h4 class="card-title"> {{$ticket['Title']}}</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      
<!-- start the top of the page  -->
              <div class="user-panel d-flex">
                    <div class="image">
                      <img src="../../../../../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                       @foreach($users as $user)
                        @if($ticket['id_user'] == $user['id'])
                          {{$user['FirstName']}} {{$user['LastName']}}
                        @endif
                      @endforeach
                    </div>
              </div>

                    </div>
                    <div class="col-md-6">
                      <span style="float: right;color: gray;">{{$ticket['created_at']}}</span>
                    </div>
<!-- end the top of the page  -->
                  </div>
                  <div class="row mt-2 pb-2 mb-2 ">
                    
                    <div class="col-md-12"><b>Objet:</b> {{$Cat['CategoryName']}}</div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <b>Problème:</b> {!! $ticket['Problem'] !!}
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
               <div >
               
            </div>
                <div class="card-footer">
                      <form action="{{route('ticket.rep.store',['id'=>$ticket->id])}}" method="POST" >
                          @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <textarea name="MessageForm" id="summernote" rows="80" required></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary">Répondre</button>
                          </div>
                          <br><br><br>
                          
                         @if($ticket['status'] == "Affected" )   
                           <div class="form-group col-md-4" 
                           @if(Auth::user()->Category!=1 &&  Auth::user()->Category!=3)
                            style="display: none" 
                            @endif
                            >
                           
                              <label for="CategoryForm">Statut de ce ticket</label>
                              <select name="StatusForm" id="inputState" class="form-control">
                                <option value="" selected disabled>
                                 
                                  <!-- {!! $ticket['status'] !!} --> Statut</option>
                                <!-- this is the current status of the ticket, if the user choose Closed we will pass the value of close to ticket controller and then change the status to Closed -->
                                <option value="1">clôturer</option>
                                @endif
                              </select>
                            </div>

                          




                          </div>
                        
                  </form>




                </div>
              </div>
              <!-- /.card-footer-->

              <!-- begin display reply-->

<!-- foreach is used here so have a loop of this form until the all replies of the specific ticket are displayed(because we are using replys which hold the whole line of the ticket reply)  -->
              @foreach($replys as $val)


              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      

              <div class="user-panel d-flex">
                    <div class="image">
                      <img src="../../../../../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                      @foreach($users as $user)
                      <!-- we need to use the if statment because if we don't use it will will print all the user names but we only need the id of the user that send the reply (it is already in the table of reply) -->
                        @if($user->id==$val['id_user'])
                        <!-- this is the user who logged in and chose the ticket  -->
                          {{$user->FirstName}} {{$user->LastName}}
                        @endif
                      @endforeach
                    </div>
              </div>

                  </div>
                    <div class="col-md-6">
                      <span style="float: right;color: gray;">{{$val['created_at']}}</span>
                    </div>
                  </div>
                  <div class="row mt-2 pb-2 mb-2">
                    <div class="col-md-12">
                      {!! $val['message'] !!}
                    </div>
                  </div>
                </div>
                  </div>
                </div>
              </div>



              @endforeach



              <!-- end display reply-->


          
              
            </div>
            <!-- /.card -->

          </section>


<!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
@endsection