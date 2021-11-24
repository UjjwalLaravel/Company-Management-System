<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    use HasFactory;
    protected $filable=['remarks', 'tender_id', 'date'];
    public $timestamps = false;
     public function tender(){
        return $this->belongsTo(Tender::class, 'tender_id');
    }
}
