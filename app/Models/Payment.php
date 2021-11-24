<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table='payments';
     public function tender(){
        return $this->belongsTo(Tender::class, 'tender_id');
    }
}
