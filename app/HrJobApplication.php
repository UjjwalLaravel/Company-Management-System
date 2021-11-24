<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HrJobApplication extends Model
{
        protected $table='recruiter_job_applications';
    protected $fillable = ['candidate_id','vacancy_id','date_of_application','source_of_application','referred_by','answer_1','answer_2','answer_3','answer_4','answer_5','answer_6','sync_status'];
    
}
