@extends('layouts.app')

@section('content')
<div class="content-header"><div class="container-fluid"><h1>Add PG Details </h1><div></div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Payment</h3>
              <form action="{{route('add_payment_data')}}" method="post" id="myForm">@csrf
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
            <div class="card-header">Payment Details</div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="inputName">Date</label>
                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="date">
                </div>
                <div class="form-group col-sm-6">
                  <label for="inputName">Department/Division</label>
                    <input type="text" class="form-control" placeholder="Department/Division" name="department">
                </div>     
              </div>  
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="inputName">R.A. Bill No.</label>
                    <input type="text" class="form-control" placeholder="Eg. First RA/ Second RA/ Final" name="ra_bill">
                </div>
                <div class="form-group col-sm-6">
                  <label for="inputName">Cheque Amount</label>
                    <input type="text" class="form-control ded" placeholder="Department/Division" name="cheque_amount" id="cheque_amount" value=0>
                </div>     
              </div>
              
              <div class="row">
                <div class="form-group col-sm-3">
                  <label for="inputName">Securities</label>
                    <input type="number" class="form-control ded" placeholder="Securities" name="security" id="security" value=0>
                </div>
                <div class="form-group col-sm-3">
                  <label for="inputName">Income Tax</label>
                    <input type="number" class="form-control ded" placeholder="Income Tax" name="income_tax" id="income_tax" value=0>
                </div>  
                <div class="form-group col-sm-3">
                  <label for="inputName">CGST</label>
                    <input type="number" class="form-control ded" placeholder="CGST" name="cgst" id="cgst" value=0>
                </div>
                <div class="form-group col-sm-3">
                  <label for="inputName">SGST</label>
                    <input type="number" class="form-control ded" placeholder="SGST" name="sgst" id="sgst" value=0>
                </div>      
              </div>
              <div class="row">
                <div class="form-group col-sm-3">
                  <label for="inputName">IGST</label>
                    <input type="number" class="form-control ded" placeholder="IGST(If any)" name="igst" id="igst" value=0>
                </div>
                <div class="form-group col-sm-3">
                  <label for="inputName">Labour Cess</label>
                    <input type="number" class="form-control ded" placeholder="Labour Cess" name="labour_cess" id="labour_cess" value=0>
                </div>  
                <div class="form-group col-sm-3">
                  <label for="inputName">Withheld</label>
                    <input type="number" class="form-control ded" placeholder="Withheld" name="withheld" id="withheld" value=0>
                </div>
                <div class="form-group col-sm-3">
                  <label for="inputName">Recovery</label>
                    <input type="number" class="form-control ded" placeholder="Recovery" name="recovery" id="recovery" value=0>
                </div>      
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="inputName">Total Deductions</label>
                    <input type="number" class="form-control" placeholder="Total Deductions" name="total_deductions" value=0 id="total_deductions">
                </div>
                <div class="form-group col-sm-6">
                  <label for="inputName">Gross Amount</label>
                    <input type="number" class="form-control" placeholder="Gross Amount" name="gross_amount" value=0 id="gross_amount">
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
          <input type="submit" value="Add New" id="publish_post" class="btn btn-lg btn-success">
        </form>
        </div>
      </div>
    </section>
</form>
@endsection
@section('internal_js')
<script type="text/javascript">
       $(document).ready(function () {
        $('.ded').on('change', function(){
          let sec = $('#security').val();
          let cheque_amount = $('#cheque_amount').val();
          let income_tax = $('#income_tax').val();
          let cgst = $('#cgst').val();
          let sgst = $('#sgst').val();
          let igst = $('#igst').val();
          let labour_cess = $('#labour_cess').val();
          let withheld = $('#withheld').val();
          let recovery = $('#recovery').val();
          let total_deductions = parseInt(sec)+parseInt(income_tax)+parseInt(cgst)+parseInt(sgst)+parseInt(igst)+parseInt(labour_cess)+parseInt(withheld)+parseInt(recovery);
          let gross = parseInt(cheque_amount)+total_deductions;
          $('#total_deductions').val(total_deductions);
          $('#gross_amount').val(gross);
        })
       })
    
</script>
@endsection