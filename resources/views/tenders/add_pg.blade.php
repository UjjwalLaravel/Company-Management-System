@extends('layouts.app')

@section('content')
<div class="content-header"><div class="container-fluid"><h1>Add PG Details </h1><div></div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add PG Details</h3>
              <form action="{{route('add_pg_data')}}" method="post" id="myForm">@csrf
            </div>
            <div class="card-body">
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="inputName">NIT No.</label>
                <input type="hidden" name="tender_id" value="{{$tender->id}}">
                <input type="text" class="form-control" placeholder="NIT No." name="nit_no" id="nit_no" maxlength="50" value="{{$tender->nit_no}}" disabled="true">
              </div>
              <div class="form-group col-sm-6">
                <label for="inputStatus">Estimated Cost</label>
                <input type="text" class="form-control" placeholder="Estimated Cost" name="est_cost" disabled="true" id="est_cost" maxlength="50" value="{{$tender->est_cost}}">
              </div>                
            </div>
            <div class="form-group">
                <label for="inputProjectLeader">Name of Work </label>
                   <div>{!! $tender->name_of_work !!}</div>
              </div> 
            <div class="row">
            <div class="form-group col-sm-6">
                <label for="inputName">Tender Status</label>
                <select id="inputStatus" class="form-control custom-select" name="tender_status">
                     <option value="1">In Progress</option>
                     <option value="2">Awarded</option>
                     <option value="3">Not Awarded</option>
                </select> 
              </div>     
           </div>  
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card primary">
            <div class="card-header">Enter PG Details</div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="inputName">Instrument Type</label>
                  <select id="inputStatus" class="form-control custom-select" name="instrument_type">
                     <option value="FDR">FDR</option>
                     <option value="DD">DD</option>
                </select> 
                </div>     
                <div class="form-group col-sm-6">
                  <label for="inputStatus">Instrument No</label>
                  <input type="text" class="form-control" placeholder="Instrument No" name="instrument_no">
                </div>
              </div>  
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="inputName">Instrument Date</label>
                    <input type="text" class="form-control" placeholder="Instrument Date" name="instrument_date">
                </div>     
                <div class="form-group col-sm-6">
                  <label for="inputStatus">Instrument Amount</label>
                  <input type="text" class="form-control" placeholder="Instrument Amount" name="instrument_amount">
                </div>
              </div>  
               <div class="row">
                <div class="form-group col-sm-12">
                  <label for="inputName">Remarks</label>
                    <input type="text" class="form-control" placeholder="Remarks" name="remarks">
                </div>     
\              </div>  
            </div>
          </div>
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