<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\PG;
use Illuminate\Http\Request;

class PGController extends Controller
{
     public function add_pg($tender_id){
        $tender=Tender::find($tender_id);
        return view('tenders.add_pg', compact('tender'));
    }

    public function add_pg_data(Request $request){
        $pg = new PG;
        $pg->tender_id = $request->tender_id;
        $pg->remarks = $request->remarks;
        $pg->instrument_type = $request->instrument_type;
        $pg->instrument_date = $request->instrument_date;
        $pg->instrument_no = $request->instrument_no;
        $pg->instrument_amount = $request->instrument_amount;
        $pg->save();
        return redirect()->route('tenders_list')->with('message', 'PG has been added successfully');
    }
}
