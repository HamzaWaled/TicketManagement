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
                  <h4 class="card-title">Modification de l'utilisateur</h4>

                </div>
                <!-- /.card-header -->
               <div >
               

              <div class="tbl">
                


                <form action="" method="POST">
                @csrf
                 <div class="form-row">
                  <input type="hidden" name="id" value="{{$dataa['id']}}">
                      <div class="form-group col-md-6">
                        <label for="FirstNameForm">Prénom</label>
                        <input type="text" class="form-control" id="fname" placeholder="Prénom" name="FirstNameForm" value="{{$dataa['FirstName']}}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="LastNameForm">Nom</label>
                        <input type="text" class="form-control" id="lname" placeholder="Nom" name="LastNameForm" value="{{$dataa['LastName']}}">
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <!-- <div class="form-group col-md-6">
                        <label for="EmailForm">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="user@example.ma" name="EmailForm" value="{{$dataa['email']}}">
                      </div> -->
                      <div class="form-group col-md-6">
                        <label for="PasswordForm">Mot de passe</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="********" name="PasswordForm" >
                        <!-- value="{{$dataa['password']}}" -->
                      </div>
                      <div class="form-group col-md-6">
                        <label for="PhoneNumberForm">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="Phone" placeholder="(+212)6 -- -- -- --"  name="PhoneNumberForm" value="{{$dataa['PhoneNumber']}}">
                      </div>
                      </div>
                      
                    </div>
                    
                    
                    <div class="form-row">
                      <div class="form-group col-md-6">
                            <div class="form-group" @if(Auth::user()->Category!=1)
                                  style="display: none" 
                                  @endif
                            >
                          <label>Société</label>
                          <select name="SocietyForm" id="Society" class="select2" data-placeholder="Société" style="width: 100%;">
                                <option selected disabled>
                                  @foreach($societies as $soc)
                                    @if(Auth::user()->Society == $soc->id ) 
                                      {{$soc->SocietyName }}
                                    @endif
                                    @endforeach
                                  </option>

                                  @foreach($societies as $soc)
                                      <option value="{{$soc->id}}"> {{$soc->SocietyName}} </option>
                                  @endforeach
                          </select>
                          
                        </div>
                        
                      </div>

                      <div class="form-group col-md-6"
                      @if(Auth::user()->Category!=0)
                     
                      style="display: none" 
                      @endif
                      >
                       <!-- even the dmin cn't chnge the type (from dmin to gent for exmple bc it ill mke  problem) -->
                      <!-- the if statement inside the div (if the condition is satisfied we will execute the style) -->
                        <label for="CategoryForm">Type d'utilisateur</label>
                        <select name="CategoryForm" id="inputState" class="form-control" >
                          
                          <!-- We have to check if the filled data is for example 'Admin', otherwise  'Admin' will be automatically filled and same thing for agent, and User
                          -If we don't do that we will find a problem when the user want to edit his profile, we category will automatically change to the first selected option, which is not correct  -->
                          <option value="1" @if($dataa['Category']==1) selected @endif >Administrateur</option>
                          <option value="2" @if($dataa['Category']==2) selected @endif >Client</option>
                          <option value="3" @if($dataa['Category']==3) selected @endif >Collaborateur</option>
                        </select>
                      </div>


                    </div>
                    <div class="form-group">

                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </form>

              </div>
            </div>

              </div>
          
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
   
@endsection

