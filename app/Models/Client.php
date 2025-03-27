<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    use HasFactory;
    protected $primaryKey = 'client_id';
    protected $fillable = ['type', 'name', 'address', 'phone1', 'phone2', 'email'];

    public function purchases() {
        return $this->hasMany(Purchase::class,'client_id', 'client_id');
    }
    public function intervetions() {
        return $this->hasMany(Intervention::class,'client_id','client_id')->orderBy('created_at', 'desc');;
    }
    
}