@extends('layouts.app')

@section('content')
<div class="content-header">
      <div class="container-fluid">
<h1>    Tender Details</h1>
<div class="card-block" style="text-align: right;padding: 10px;margin: 10px;">
        <!--<h4 class="sub-title">Input Validation</h4>-->
      <a href="{{url('add-milestone', $tender->id)}}" class="pull-right"><button type="button" class="btn btn-info">Add New Milestone</button></a>
      <a href="{{url('add-payment', $tender->id)}}" class="pull-right"><button type="button" class="btn btn-info">Add New Payment</button></a>
</div>
<div class="card">
      <div class="card-body">
            <div class="row">
                  <div class="col-md-6">
                        <div class="card-block" style="text-align: right;padding: 10px;margin: 10px;">
      <a href="{{url('edit-tender', $tender->id)}}" class="pull-right" title="Edit Details"><i class="fa fa-pencil-alt"></i></a>
</div>
                        <p><strong>NIT No.</strong>: {{$tender->nit_no}}</p>
                        <strong>Name of Work</strong>: {!! $tender->name_of_work !!}
                        <p><strong>Estimated Cost</strong>: {{$tender->est_cost}}</p>
                        <p><strong>Tender Status</strong>: {{$tender->status}}</p>
                        <p><strong>Tendered Amount</strong>: {{$tender->tendered_amount}}</p>
                        <p><strong>Remarks</strong>: {{$tender->remarks}}</p>
                  </div>
                  <div class="col-md-6">
                        <div class="card-block" style="text-align: right;padding: 10px;margin: 10px;">
      <a href="{{url('edit-award-details', $tender->id)}}" class="pull-right" title="Edit Details"><i class="fa fa-pencil-alt"></i></a>
</div>
                        <p><strong>Agreement No</strong>: {{$tender->agreement_no}}</p>
                        <p><strong>Date of Start</strong>: {{$tender->date_of_start}}</p>
                        <p><strong>Date of Start(As per Agreement)</strong>: {!! $tender->date_of_start_agreement !!}</p>
                        <p><strong>Date of Completion</strong>: {{$tender->date_of_completion}}</p>
                        <p><strong>Date of Completion(As per Agreement)</strong>: {{$tender->date_of_completion_agreement}}</p>
                        <p><strong>Percentage (%) Below</strong>: {{$tender->percent_below}}</p>
                        <p><strong>Time Allowed</strong>: {{$tender->time_period}}</p>
                        <p><strong>Project Type</strong>: {{$tender->project_type}}</p>
                  </div>
            </div>
      </div>
</div>
<!-- PG Details Start -->
            @if(isset($tender->pg))
            <div class="row">

                  <div class="col-sm-6">
                        <div class="card">
                  
                              <div class="card-header">
                                    <div class="row">
                                          <div class="col-md-9"><h4>PG Details</h4></div>
                                          <div class="col-md-3"><div class="btn btn-info">{{$tender->return_pg_status($tender->pg_status)}}</div></div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <p><strong>Instrument Type</strong>: {{$tender->pg->instrument_type}}</p>
                                    <p><strong>Instrument Date</strong>: {{$tender->pg->instrument_date}}</p>
                                    <p><strong>Instrument Number</strong>: {{$tender->pg->instrument_no}}</p>
                                    <p><strong>Instrument Amount</strong>: {{$tender->pg->instrument_amount}}</p>
                                    <p><strong>Instrument Remarks</strong>: {{$tender->pg->remarks}}</p>
                              </div>
                        </div>
                  </div>
            </div>
            @endif
<!-- /PG Details -->

<!-- Project Timeline Details -->
 @if(count($tender->milestones)>0)
            <div class="row">

                  <div class="col-sm-12">
                        <div class="card">
                  
                              <div class="card-header">
                                    <div class="row">
                                          <div class="col-md-12"><h4>Project Milestones</h4></div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <table class="example table">
                                          <tr>
                                                <th>Date</th>
                                                <th>Particulars</th>
                                                <th>Actions</th>
                                          </tr>
                                          @foreach($tender->milestones as $milestone)
                                          <tr>
                                                <td>{{$milestone->date}}</td>
                                                <td>{{$milestone->particulars}}</td>
                                                <td>
                                                      <a href="{{url('delete-milestone/'.$milestone->id)}}"><i class="fa fa-trash"></i></a>
                                                </td>
                                          </tr>
                                          @endforeach
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
            @endif

<!-- /Project Timeline Details -->

<!-- Project Payment Details -->
 @if(count($tender->payments)>0)
            <div class="row">

                  <div class="col-sm-12">
                        <div class="card">
                  
                              <div class="card-header">
                                    <div class="row">
                                          <div class="col-md-12"><h4>Project Payments</h4></div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <table class="example table">
                                          <tr>
                                                <th>Date</th>
                                                <th>Department</th>
                                                <th>Description</th>
                                                <th>Cheque Amount</th>
                                                <th>Securities</th>
                                                <th>Income Tax</th>
                                                <th>Labour Cess</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th>IGST</th>
                                                <th>Withheld</th>
                                                <th>Recovery</th>
                                                <th>Total Deductions</th>
                                                <th>Gross Amount</th>
                                                <th>Actions</th>
                                          </tr>
                                          @foreach($tender->payments as $payment)
                                          <tr>
                                                <td>{{$payment->date}}</td>
                                                <td>{{$payment->department}}</td>
                                                <td>{{$payment->remarks}}</td>
                                                <td>{{$payment->cheque_amount}}</td>
                                                <td>{{$payment->security}}</td>
                                                <td>{{$payment->income_tax}}</td>
                                                <td>{{$payment->labour_cess}}</td>
                                                <td>{{$payment->cgst}}</td>
                                                <td>{{$payment->sgst}}</td>
                                                <td>{{$payment->igst}}</td>
                                                <td>{{$payment->withheld}}</td>
                                                <td>{{$payment->recovery}}</td>
                                                <td>{{$payment->total_deductions}}</td>
                                                <td>{{$payment->gross_amount}}</td>
                                                <td>
                                                      <a href="{{url('delete-payment/'.$payment->id)}}"><i class="fa fa-trash"></i></a>
                                                      <a href="{{url('edit-payment/'.$payment->id)}}"><i class="fa fa-pencil-alt"></i></a>
                                                </td>
                                          </tr>
                                          @endforeach
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
            @endif

<!-- /Project Payment Details -->

      </div><!-- /.container-fluid -->
    </div>
@endsection

