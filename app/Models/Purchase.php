<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Purchase extends Model {
    use HasFactory;
    protected $primaryKey = 'purchase_id';

    protected $fillable = ['client_id', 'extinguisher_id', 'quantity', 'intervention_date'];

    public function client() {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function extinguisher() {
        
        return $this->belongsTo(Extinguisher::class, 'extinguisher_id', 'extinguisher_id');
    }

    public function nextIntervention() {
        return Carbon::parse($this->intervention_date)->addMonths(6);
    }
}