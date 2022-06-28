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
                  <h2 class="card-title"> La liste des utilisateurs  </h2>
                  
                    <div class="page-content page-container" id="page-content">
                          <div class="ADD_btn">
                              <button  type="button" class="btn btn-primary btn-sm"><a style="color: white; " href="/UserFillingForm" class="nav-link"> <i class="fas fa-plus"></i> Ajouter un utilisateur </a></button>
                          </div>
                      </div>
               </div>
                <!-- /.card-header -->
               <div >
               

              <div class="tbl">
                


                 <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color:#f2f2f2; color: Black;  text-align: center;">
                  <tr>
                    <th><h4>Société</h4></th>
                    <th><h4>Nom</h4></th>
                    <th><h4>Prénom</h4></th>
                    
                    
                    <th><h4>Catégorie d'utilisateur</h4></th>
                    <th><h4>E-mail</h4></th>
                    <th><h4>Numéro de téléphone</h4></th>
                    
                    <th><h4>Action</h4></th>
                  </tr>
                  </thead>
                  <!-- display is the variable where we have stored data in usercontroller and User is the model -->
                  @foreach($display as $User)
                   <tr>
                    <input type="hidden" class="sedelete_val" value="{{$User['id']}}">
                    <td>
                      @foreach($societies as $soci)
                        @if($User['Society'] == $soci['id'])
                          {{$soci['SocietyName']}}
                        @endif
                      @endforeach
                    </td>
                    <td>{{$User['LastName']}}</td>
                    <td>{{$User['FirstName']}}</td>
                    
                    
                    <td>
                      <?php
                      if ($User['Category']== 1) {
                        echo('Administrateur');
                      }Else if ($User['Category']== 2){
                      echo('Client');
                    }Else{
                    echo('Collaborateur');
                  }
                  ?>
                    </td>
                    <td>{{$User['email']}}</td>
                    <td>{{$User['PhoneNumber']}}</td>
                    
                    <td>
                      <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button type="button" class="dropdown-item " > 
                              <a href="{{route('user.editt',['id'=>$User['id']])}}">Éditer</a>
                            </button>
                            <button class="btn servideletebtn" type="button" onclick="return REMOVE('{{route('user.deletee',['id'=>$User['id']])}}')" >
                              Supprimer
                            </button>
                            
                          </div>
                        </div>
                    </td>
                    
                  </tr>
                  @endforeach
                  
                  
                  
                </table>

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
@section('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": []
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
<script>

</script>
@endsection

