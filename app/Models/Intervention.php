<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;
    protected $primaryKey = 'intervention_id';

    protected $fillable = ['client_id', 'intervention_date', 'comment'];

    // Relationship: An intervention belongs to a client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}