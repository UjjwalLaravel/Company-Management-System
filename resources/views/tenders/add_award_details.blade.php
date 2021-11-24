@extends('layouts.app')

@section('content')
<div class="content-header"><div class="container-fluid"><h1>Add Tender Details </h1><div></div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Tender Details</h3>
              <form action="{{route('add_award_details_data')}}" method="post" id="myForm">@csrf
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
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card primary">
            <div class="card-header">Enter Tender Details</div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-sm-3">
                  <label for="inputName">Date of Start</label>
                  <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_of_start">
                </div>     
                <div class="form-group col-sm-3">
                  <label for="inputStatus">Date of Completion</label>
                  <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_of_completion">
                </div>
                <div class="form-group col-sm-3">
                  <label for="inputName">Date of Start(As per Agreement)</label>
                  <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_of_start_agreement">
                </div>     
                <div class="form-group col-sm-3">
                  <label for="inputStatus">Date of Completion(As per Agreement)</label>
                  <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="date_of_completion_agreement">
                </div>
              </div>  
              <div class="row">
                 <div class="form-group col-sm-3">
                  <label for="inputStatus">Tendered Amount</label>
                  <input type="text" class="form-control" placeholder="Tendered Amount" name="tendered_amount">
                </div>
                <div class="form-group col-sm-3">
                  <label for="inputStatus">Percentage(%) Below</label>
                  <input type="text" class="form-control" placeholder="Percentage(%) Below" name="percent_below">
                </div>
                <div class="form-group col-sm-6">
                  <label for="inputName">Time Period</label>
                    <input type="text" class="form-control" placeholder="Time Period" name="time_period">
                </div>     
              </div>  
               <div class="row">
                <div class="form-group col-sm-6">
                  <label for="inputName">Remarks</label>
                    <input type="text" class="form-control" placeholder="Remarks" name="remarks">
                </div>     
                <div class="form-group col-sm-6">
                  <label for="inputName">Agreement No</label>
                    <input type="text" class="form-control" placeholder="Agreement No." name="agreement_no">
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