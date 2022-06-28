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
                  <h4 class="card-title"> Création de ticket</h4>

                  
                   <div class="ADD_btn">
                              <button  type="button" class="btn btn-primary btn-sm"><a style="color: white;" href="/DisplayTable" class="nav-link"> <i class="fa fa-angle-left"></i>  Retour</a></button>
                          </div>
                   
                </div>
                <!-- /.card-header -->
               <div >
               


                <form action="save-ticket" method="POST" id="FrmSub" style="padding: 5px">
                  @csrf
                  <input type="hidden" name="btn_sub" id="btn_sub" value="no">
                  <div class="form-group">
                    <label for="TitleForm" >Titre</label>

                    <input type="textarea" class="form-control" id="title" placeholder="Écrivez le titre de votre ticket.." name="TitleForm" required>
                  </div>
                   
                    <div class="form-row">
                    
                    <div class="form-group col-md-6">
                      <label for="CatForm">Catégorie</label>
                      <select name="CatForm" id="Category" class="form-control" required>

                        <option selected disabled>Choisir...</option>

                          @foreach($categories as $row)
                              <option value="{{$row->id}}"> {{$row->CategoryName}} </option>
                          @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                <div class="form-group" @if(Auth::user()->Category!=1 && Auth::user()->Category!=3 )
                      style="display: none" 
                      @endif
                      >
                  <label>Société</label>
                  <select name="SocietyForm" id="SocietyForm" class="select2" data-placeholder="Select a State" style="width: 100%;" required>
                        <option selected disabled>Choisir...</option>

                          @foreach($societies as $soc)
                              <option value="{{$soc->id}}"> {{$soc->SocietyName}} </option>
                          @endforeach
                  </select>
                  
                </div>

              </div>
                    
                  </div>
                  <div class="form-group col-md-12">
                    <label for="ProblemForm">Description du problème</label>
                    <textarea name="ProblemForm" id="summernote" rows="80" required></textarea>
                  </div>


                  <button type="submit" class="btn btn-primary">Enregistrer le ticket</button>
                  @if(Auth::user()->Category==1 || Auth::user()->Category==3)
                    <button  type="button" class="btnn btn-primary btn-sm " onclick="TYPE_BTN();">Enregistrer et partager</button>
                    <!-- HEN YOU ll get yes as anser you ll go to FrmSub nd run it, then the value ll change to yes (it is no by default) -->
                  @endif
                </form>



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
          .btnn{
            float: right;
          }
        </style>
        <!-- /.content-wrapper -->
@endsection
@section('script')

<script type="text/javascript">

  function TYPE_BTN()
  {
    $("#btn_sub").val("yes")
    var btn_type_val = $("#btn_sub").val();
    //alert();
    if(btn_type_val=="yes"){
      $("#FrmSub").submit();
    }
  }
</script>

@endsection