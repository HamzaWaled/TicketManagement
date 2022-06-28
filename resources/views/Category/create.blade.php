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
                  <h4 class="card-title"> Créer une nouvelle catégorie:</h4>
                      <div class="ADD_btn">
                              <button  type="button" class="btn btn-primary btn-sm"><a style="color: white;" href="/ViewCategory" class="nav-link"> <i class="fa fa-angle-left"></i>  Retour</a></button>
                          </div>
                  
                    
                </div>
                <!-- /.card-header -->
               <div >
               <form action="save-category" method="POST" style="padding: 5px">
                  @csrf
                  <div class="form-group">
                  <input type="textarea" class="form-control" id="title" placeholder="Catégorie.." name="CategoryForm">
                  </div>
                  <button type="submit" class="btn btn-primary ServiceButton">Créer une catégorie</button>
                </form>
            </div>
                
              </div>
          
              <!-- /.card-footer-->
            
            <!-- /.card -->

          </section>

        <section class="content-header">
            
          </section>

          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="card card-default">
                <div class="card-header">
                  <h4 class="card-title"> Liste des catégories disponibles:</h4>
                      <!-- code here -->
                     <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color:#f2f2f2; color: Black;  text-align: center;">
                  <tr>
                    <th><h4>Catégories </h4></th>
                    
                    
                  </tr>
                  </thead>
                  
                  @foreach($displaying as $categorie)
                   <tr>
                    <td>{{$categorie['CategoryName']}}</td>
                    
                    
                    
                  </tr>
                  @endforeach
                  
                  
                  
                </table>
                </div>
                <!-- /.card-header -->
              
                
              </div>
          
              <!-- /.card-footer-->
            
            <!-- /.card -->

          </section>
 </div>

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