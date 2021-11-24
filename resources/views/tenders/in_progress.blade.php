@extends('layouts.app')

@section('content')
<?php $vacancies=[];
$vacancy = (object)['id' => ''];
?>
<div class="content-header">
      <div class="container-fluid">
            <h1>Tenders In Progress</h1>
      </div><!-- /.container-fluid -->
</div>
<div class="card-block" style="text-align: right;padding: 10px;margin: 10px;">
        <!--<h4 class="sub-title">Input Validation</h4>-->
      <a href="{{route('add-tender')}}" class="pull-right"><button type="button" class="btn btn-info">Add New Tender</button></a>
</div>
        
<div class="row">
    <div class="col-12 col-sm-12">
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">In Progress <span class="badge badge-info right" id="initiate1"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Awarded <span class="badge badge-info right" id="initiate2"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Not Awarded <span class="badge badge-info right" id="initiate3"></span></a>
            </li>
          </ul>
        </div>
        <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                              <div class="card-header"><h3 class="card-title">Tenders In Progress</h3></div>
                              <div class="card-body table-responsive p-0">
                                <table id="example1" class="example table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Name of Work</th>
                                            <th>Estimated Cost</th>
                                            <th>NIT No.</th>                    
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1;@endphp
                                        @foreach($tenders_progress as $tender)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{!! $tender->name_of_work !!}</td>
                                            <td>{{$tender->est_cost}}</td>
                                            <td>{{$tender->nit_no}}</td>
                                            <td>
                                                
                                                <div class="dropdown-primary dropdown open">
                                                      <a href="{{url('tender/'.$tender->id)}}"><i class="fa fa-eye"></i></a>
                                                      <a href="{{url('edit-tender/'.$tender->id)}}"><i class="fa fa-pencil"></i></a>
                                                      <a href="{{url('delete-tender/'.$tender->id)}}" title="Delete Tenders"><i style="color:red" class="fa fa-trash"></i></a>
                                                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Set as</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{url('award-tender/'.$tender->id)}}" >Awarded</a>
                                                        <a class="dropdown-item waves-light waves-effect" href="{{url('not-award-tender/'.$tender->id)}}"  >Not Awarded</a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>            
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
                </div>
              <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                              <div class="card-header"><h3 class="card-title">Tenders Awarded</h3></div>
                              <div class="card-body table-responsive p-0">
                                <table id="example2" class="example table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                           <th>S.N</th>
                                            <th>Name of Work</th>
                                            <th>Estimated Cost</th>
                                            <th>NIT No.</th>                    
                                            <th>Action</th>
                                            <th>PG Status</th>
                                            <th>Set PG Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1;@endphp
                                        @foreach($tenders_awarded as $tender)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{!! $tender->name_of_work !!}</td>
                                            <td>{{$tender->est_cost}}</td>
                                            <td>{{$tender->nit_no}}</td>
                                            <td>
                                                <a href="{{url('tender/'.$tender->id)}}" title="View Details"><i class="fa fa-eye"></i></a>
                                                <a href="{{url('add-pg/'.$tender->id)}}" title="Add PG Details"><i class="fa fa-university"></i></a>
                                                <a href="{{url('add-award-details/'.$tender->id)}}" title="Add Other Award Details"><i class="fa fa-pencil-alt"></i></a>
                                                <a href="{{url('delete-tender/'.$tender->id)}}" title="Delete Tenders"><i style="color:red" class="fa fa-trash"></i></a>

                                            </td>
                                            <td>{{$tender->return_pg_status($tender->pg_status)}}</td>
                                            <td>
                                                <div class="dropdown-primary dropdown open">
                                                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Set Status</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{url('set-pg-status/1/'.$tender->id)}}" >Created</a>
                                                        <a class="dropdown-item waves-light waves-effect" href="{{url('set-pg-status/2/'.$tender->id)}}"  >Submitted</a>
                                                        <a class="dropdown-item waves-light waves-effect" href="{{url('set-pg-status/3/'.$tender->id)}}"  >Released</a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>            
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                   <div class="row">
                        <div class="col-12">
                            <div class="card">
                              <div class="card-header"><h3 class="card-title">Tenders Not Awarded</h3></div>
                              <div class="card-body table-responsive p-0">
                               <table id="example2" class="example table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                           <th>S.N</th>
                                            <th>Name of Work</th>
                                            <th>Estimated Cost</th>
                                            <th>NIT No.</th>                    
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1;@endphp
                                        @foreach($tenders_not_awarded as $tender)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{!! $tender->name_of_work !!}</td>
                                            <td>{{$tender->est_cost}}</td>
                                            <td>{{$tender->nit_no}}</td>
                                            <td>
                                                <a href="{{url('tender/'.$tender->id)}}"><i class="fa fa-eye"></i></a>
                                                <a href="{{url('delete-tender/'.$tender->id)}}" title="Delete Tenders"><i style="color:red" class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>            
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
              </div>
             
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
       
        </div>
      

@endsection
@section('internal_js')
<script type="text/javascript">
       $(document).ready(function () {
    $("table.example").DataTable({
      "responsive": true, "autoWidth": false,"pagingType": "full_numbers","lengthChange": true,});});
</script>
@endsection