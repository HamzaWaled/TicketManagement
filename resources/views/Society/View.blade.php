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
                  <h4 class="card-title"> La liste des sociétés</h4>
<div class="ADD_btn">
               <button type="button" class="btn btn-primary btn-sm"><a style="color:white;" href="/CreateSociety"><i class="fas fa-plus"></i> Ajouter une nouvelle société</a></button>

             </div>  
                </div>
                <!-- /.card-header -->
               <div >
               

              <div class="tbl">
                <br>
               
              <br>
              <br>

                <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color:#f2f2f2; color: Black;  text-align: center;">
                  <tr>
                    <th><h4>Sociétés</h4></th>
                    <th><h4>Actions</h4></th>
                    
                  </tr>
                  </thead>
                  
                  @foreach($displaying as $society)
                   <tr>
                    <td>{{$society['SocietyName']}}</td>
                    
                    <td>
                      <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('Society.edit',['id'=>$society['id']])}}">Éditer</a>
                            <button type="button" onclick="return REMOVE('{{route('Society.delete',['id'=>$society['id']])}}')" class="btn servideletebtn">
                              supprimer
                            </button>
                           
                            
                          </div>
                        </div>
                      
                      
                    </td>
                    
                  </tr>
                  @endforeach
                  
                  
                  
                </table>
<style>
.ADD_btn{
  float: right;
  
}
</style>





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
@endsection