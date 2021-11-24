<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMilestone;
use App\Models\Tender;

class ProjectMilestoneController extends Controller
{
    public function add_milestone($tender_id){
        $tender = Tender::find($tender_id);
        return view('project_milestone.add', compact('tender'));
    }

    public function add_milestone_data(Request $request){
        $proj_mile=new ProjectMilestone;
        $proj_mile->date = $request->date;
        $proj_mile->tender_id = $request->tender_id;
        $proj_mile->particulars = $request->remarks;
        $proj_mile->save();
        return redirect()->route('tender', $request->tender_id)->with('message', 'Project Milestone has been added successfully');

    }

    public function delete($id){
        ProjectMilestone::find($id)->delete();
        return redirect()->back()->with('message', 'Milestone has been deleted successfully');
    }
    //
}
