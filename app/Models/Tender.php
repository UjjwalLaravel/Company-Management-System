<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProjectMilestone;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tenders';
    protected $fillable = ['nit_no', 'est_cost', 'tendered_amount', 'name_of_work','tender_status', 'date_of_start', 'date_of_start_agreement','date_of_completion','date_of_completion_agreement', 'remarks', 'percent_below', 'project_type', 'pg_status', 'agreement_no'];

    public function set_status($tender){
        if($tender->tender_status == '1'){$tender->status = 'In Progress';}
        if($tender->tender_status == '2'){$tender->status = 'Awarded';}
        if($tender->tender_status == '3'){$tender->status = 'Not Awarded';}
        return $tender;
    }
    public function return_pg_status($pg_status){
        if($pg_status == '0'){return 'Not Created';}
        if($pg_status == '1'){return 'PG Created';}
        if($pg_status == '2'){return 'PG Submitted';}
        if($pg_status == '3'){return 'PG Released';}
    }

    public function pg(){
        return $this->hasOne(PG::class, 'tender_id');
    }

    public function milestones(){
        return $this->hasMany(ProjectMilestone::class, 'tender_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'tender_id');
    }
}
