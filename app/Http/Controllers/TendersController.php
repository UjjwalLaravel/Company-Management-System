<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\PG;

class TendersController extends Controller
{
    public function in_progess_list(){
        $tenders_progress = Tender::where('tender_status', '1')->get();
        $tenders_awarded = Tender::where('tender_status', '2')->get();
        $tenders_not_awarded = Tender::where('tender_status', '3')->get();
        return view('tenders.in_progress', compact('tenders_progress', 'tenders_awarded', 'tenders_not_awarded'));
    }

    public function add_tender(){
        return view('tenders.add_tender');
    }

     public function edit_tender($tender_id){
        $tender = Tender::find($tender_id);
        return view('tenders.edit_tender', compact('tender'));
    }

    public function add_tender_data(Request $request){
        $tender = new Tender;
        $tender->tender_status = $request->tender_status;
        $tender->nit_no = $request->nit_no;
        $tender->est_cost = $request->est_cost;
        $tender->name_of_work = $request->name_of_work;
        $tender->project_type = $request->project_type;
        $tender->save();
        return redirect()->back()->with('message', 'Tender has been added successfully');
    }

    public function edit_tender_data(Request $request, $tender_id){
        $tender = Tender::find($tender_id);
        $tender->tender_status = $request->tender_status;
        $tender->nit_no = $request->nit_no;
        $tender->est_cost = $request->est_cost;
        $tender->name_of_work = $request->name_of_work;
        $tender->project_type = $request->project_type;
        $tender->save();
        return redirect()->route('tender', $tender_id)->with('message', 'Tender has been updated successfully');
    }

    public function award_tender(Request $request){
        $tender_id = $request->id;
        Tender::where('id', $tender_id)->update(['tender_status'=> '2']);
        return redirect()->back()->with('message', 'Tender has been awarded successfully');
    }

    public function not_award_tender(Request $request){
        $tender_id = $request->id;
        Tender::where('id', $tender_id)->update(['tender_status'=> '3']);
        return redirect()->back()->with('message', 'Tender has been awarded successfully');
    }
    public function show_tender(Request $request){
        $tender = Tender::find($request->id);
        $tender = $tender->set_status($tender);
        return view('tenders.show_tender', compact('tender'));
        
    }
    public function add_pg($tender_id){
        $tender=Tender::find($tender_id);
        return view('tenders.add_pg', compact('tender'));
    }

    public function change_pg_status($status, $id){
        Tender::where('id',$id)->update(['pg_status'=> $status]);
        return redirect()->back()->with('message', 'PG Status has been changed successfully');

    }

    public function add_award_details($tender_id){
        $tender = Tender::find($tender_id);
        return view('tenders.add_award_details', compact('tender'));
    }
     public function add_award_details_data(Request $request){
        $tender_id = $request->tender_id;
        $tender = Tender::find($tender_id);
        $tender->percent_below = $request->percent_below;
        $tender->date_of_start = $request->date_of_start;
        $tender->date_of_start_agreement = $request->date_of_start_agreement;
        $tender->agreement_no = $request->agreement_no;
        $tender->date_of_completion = $request->date_of_completion;
        $tender->date_of_completion_agreement = $request->date_of_completion_agreement;
        $tender->tendered_amount = $request->tendered_amount;
        $tender->remarks = $request->remarks;
        $tender->time_period = $request->time_period;
        $tender->save();
        return redirect()->route('tender', $tender_id)->with('message', 'Tender Details have been added successfully');
    }

     public function edit_award_details($tender_id){
        $tender = Tender::find($tender_id);
        return view('tenders.edit_award_details', compact('tender'));
    }

    public function edit_award_details_data(Request $request, $tender_id){
        $tender = Tender::find($tender_id);
        $tender->percent_below = $request->percent_below;
        $tender->date_of_start = $request->date_of_start;
        $tender->date_of_start_agreement = $request->date_of_start_agreement;
        $tender->date_of_completion = $request->date_of_completion;
        $tender->date_of_completion_agreement = $request->date_of_completion_agreement;
        $tender->agreement_no = $request->agreement_no;
        $tender->tendered_amount = $request->tendered_amount;
        $tender->remarks = $request->remarks;
        $tender->time_period = $request->time_period;
        $tender->save();
        return redirect()->route('tender', $tender_id)->with('message', 'Tender Details have been updated successfully');
    }

    public function delete($id){
        Tender::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Tender has been deleted successfully');
    }
    //
}
