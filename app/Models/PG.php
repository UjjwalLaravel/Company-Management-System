<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PG extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='pg';
    protected $fillable = ['instrument_no', 'instrument_date', 'instrument_amount','instrument_type', 'tender_id'];

    public function tender(){
        return $this->belongsTo(Tender::class, 'tender_id');
    }

    
}
