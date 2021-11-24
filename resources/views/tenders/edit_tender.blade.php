@extends('layouts.app')

@section('content')
<div class="content-header"><div class="container-fluid"><h1>Edit Tender Details</h1><div></div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Tender Details</h3>
              <form action="{{route('edit_tender_data', $tender->id)}}" method="post" id="myForm">@csrf
            </div>
            <div class="card-body">
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="inputName">NIT No.</label>
                <input type="text" class="form-control" placeholder="NIT No." name="nit_no" id="nit_no" maxlength="50" value="{{$tender->nit_no}}">
                @error('nit_no')<span class='text-danger' id="rn_danger">{{$message}}</span>@enderror
                <span class='text-danger' id="rn_danger"></span>
              </div>
              <div class="form-group col-sm-6">
                <label for="inputStatus">Estimated Cost</label>
                <input type="text" class="form-control" placeholder="Estimated Cost" name="est_cost" id="est_cost" maxlength="50" value="{{$tender->est_cost}}">
                @error('est_cost')<span class='text-danger'>{{$message}}</span>@enderror
              </div>                
            </div>
            <div class="form-group">
                <label for="inputProjectLeader">Name of Work </label>
                   <textarea name="name_of_work" id="name_of_work" rows="10" cols="80" class="ckeditor" required>{{$tender->name_of_work}}</textarea>
                   <span class='text-danger' id="name_of_work"></span>
              </div>
          
          
            <div class="row">
            <div class="form-group col-sm-6">
                <label for="inputName">Tender Status</label>
                <select id="inputStatus" class="form-control custom-select" name="tender_status">
                     <option value="1" <?php if($tender->tender_status == '1') {echo 'selected';}?>>In Progress</option>
                     <option value="2" <?php if($tender->tender_status == '2') {echo 'selected';}?>>Awarded</option>
                     <option value="3" <?php if($tender->tender_status == '3') {echo 'selected';}?>>Not Awarded</option>
                </select> 
                @error('tender_status')<span class='text-danger'>{{$message}}</span>@enderror
              </div>  
               <div class="form-group col-sm-6">
                <label for="inputName">Project Type</label>
                <select id="inputStatus" class="form-control custom-select" name="project_type">
                     <option value="Project" <?php if($tender->project_type == 'Project') {echo 'selected';}?>>Project</option>
                     <option value="Maintenance" <?php if($tender->project_type == 'Maintenance') {echo 'selected';}?>>Maintenance</option>
                </select> 
                @error('project_type')<span class='text-danger'>{{$message}}</span>@enderror
              </div>       
           </div>            
           


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      <div class="row text-center">
        <div class="col-12 text-center">
          <input type="submit" value="Post" id="publish_post" class="btn btn-lg btn-success">
        </form>
        </div>
      </div>
    </section>
</form>
@endsection

@section('internal_js')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){
      CKEDITOR.replace( 'name_of_work' );
</script>
@endsection