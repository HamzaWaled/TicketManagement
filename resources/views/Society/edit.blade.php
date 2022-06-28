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
                  <h4 class="card-title"> <b>Le nouveau nom de cette société:<b></h4>

                  
                </div>
                <!-- /.card-header -->
               <div >
               <form action="" method="POST" style="padding: 5px">
                  @csrf
                  <div class="form-group">
                  <input type="textarea" class="form-control" id="title" placeholder="nouvelle société.." name="SocietyForm" value="{{$data['SocietyName']}}">
                  </div>
                  <button type="submit" class="btn btn-primary"> Modifier la société</button>
                </form>



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