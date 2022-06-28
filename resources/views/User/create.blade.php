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
                  <h4 class="card-title"> Créer un utilisateur</h4>
                    <div class="ADD_btn">
                              <button  type="button" class="btn btn-primary btn-sm"><a style="color: white;" href="/ListUsers" class="nav-link"> <i class="fa fa-angle-left"></i>  Retour</a></button>
                    </div>
                
                </div>
                <!-- /.card-header-->
               <div >
               

              <div class="tbl">
                


                <form action="save-client" method="POST" style="padding: 5px;">
                @csrf
                 <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="FirstNameForm">Prénom</label>
                        <input type="text" class="form-control" id="fname" placeholder="Prénom" name="FirstNameForm" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="LastNameForm">Nom </label>
                        <input type="text" class="form-control" id="lname" placeholder="Nom" name="LastNameForm" required>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="EmailForm">E-mail</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="exemple@exp.ma" name="EmailForm" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="PasswordForm">Mot de passe</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="********" name="PasswordForm" required>
                      </div>
                    </div>
                    
                    
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="PhoneNumberForm">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="Phone" placeholder="(+212)6 -- -- -- -- " name="PhoneNumberForm" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="CategoryForm">Type d'utilisateur</label>
                        <select name="CategoryForm" id="inputState" class="form-control" required>
                          <option value="1">Administrateur</option>
                          <option value="2">Client</option>
                          <option value="3">Collaborateur</option>
                        </select>
                      </div>
                      

              <div class="col-md-12">
                <div class="form-group">
                  <label>Société</label>
                  <select name="SocietyForm" id="Society" class="select2" data-placeholder="Select a State" style="width: 100%;" required>
                        <option selected disabled required>Choisir...</option>

                          @foreach($societies as $soc)
                              <option value="{{$soc->id}}" required> {{$soc->SocietyName}} </option>
                          @endforeach
                  </select>
                  
                </div>

              </div>


                     
                    </div>
                    <div class="form-group">

                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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
   <style>
            .ADD_btn{
            float: right;
            
            } 

        </style>
@endsection

