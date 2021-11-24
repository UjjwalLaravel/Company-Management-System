<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function add_payment($tender_id){
        $tender = Tender::find($tender_id);
        return view('tenders.payment_add', compact('tender'));
    }

    public function edit_payment($payment_id){
        $payment = Payment::find($payment_id);
        $tender = Tender::find($payment->tender_id);
        return view('tenders.payment_edit', compact('payment', 'tender'));
    }

    public function add_payment_data(Request $request){
        $payment = new Payment;
        $payment->tender_id = $request->tender_id;
        $payment->date = $request->date;
        $payment->department = $request->department;
        $payment->ra_bill = $request->ra_bill;
        $payment->cheque_amount = $request->cheque_amount;
        $payment->security = $request->security;
        $payment->income_tax = $request->income_tax;
        $payment->cgst = $request->cgst;
        $payment->sgst = $request->sgst;
        $payment->igst = $request->igst;
        $payment->labour_cess = $request->labour_cess;
        $payment->withheld = $request->withheld;
        $payment->recovery = $request->recovery;
        $payment->total_deductions = $request->total_deductions;
        $payment->gross_amount = $request->gross_amount;
        $payment->remarks = $request->remarks;
        $payment->save();
        return redirect()->route('tender', $request->tender_id)->with('message', 'Payment Detail has been added successfully');
    }

     public function edit_payment_data(Request $request, $payment_id){
        $payment = Payment::find($payment_id);
        $payment->tender_id = $request->tender_id;
        $payment->date = $request->date;
        $payment->department = $request->department;
        $payment->ra_bill = $request->ra_bill;
        $payment->cheque_amount = $request->cheque_amount;
        $payment->security = $request->security;
        $payment->income_tax = $request->income_tax;
        $payment->cgst = $request->cgst;
        $payment->sgst = $request->sgst;
        $payment->igst = $request->igst;
        $payment->labour_cess = $request->labour_cess;
        $payment->withheld = $request->withheld;
        $payment->recovery = $request->recovery;
        $payment->total_deductions = $request->total_deductions;
        $payment->gross_amount = $request->gross_amount;
        $payment->remarks = $request->remarks;
        $payment->update();
        return redirect()->route('tender', $request->tender_id)->with('message', 'Payment Detail has been updated successfully');
    }

     public function delete($id){
        Payment::find($id)->delete();
        return redirect()->back()->with('message', 'Payment has been deleted successfully');
    }
}
