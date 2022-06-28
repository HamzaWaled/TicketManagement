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
                  <h4 class="card-title"> Modifier le ticket</h4>

                  
                </div>
                <!-- /.card-header -->
               <div >
               


              <form action="" method="POST" style="padding: 5px">
                  @csrf
                  <div class="form-group">
                    <input type="hidden" name="id" value="{{$datas['id']}}">
                    <label for="TitleForm">Titre</label>

                    <input type="textarea" class="form-control" id="title" placeholder="Write title of your ticket.." name="TitleForm" value="{{$datas['Title']}}">
                  </div>
                   
                    <div class="form-row">
                    
                    <div class="form-group col-md-12">
                      <label for="CatForm">Catégorie</label>
                      <select name="CatForm" id="Category" class="form-control" value="{{$datas['Cat']}}">
                        <option selected disabled>
                          @foreach($categories as $ct)
                                    @if($datas['Cat'] == $ct->id ) 
                                      {{$ct->CategoryName }}
                                    @endif
                                    @endforeach
                          


                        </option>
                        @foreach($categories as $row)
                              <option value="{{$row->id}}"> {{$row->CategoryName}} </option>
                          @endforeach
                        
                      </select>
                    </div>
                    
                  </div>
                  <div class="form-group col-md-12">
                    <label for="ProblemForm">Description du problème</label>
                    <textarea name="ProblemForm" id="summernote" rows="80">{{$datas['Problem']}}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Modifier</button>

                </form>






          
          
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection