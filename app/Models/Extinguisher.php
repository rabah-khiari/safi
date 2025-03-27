<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extinguisher extends Model {
    use HasFactory;
    protected $primaryKey = 'extinguisher_id';
    protected $fillable = ['type', 'size', 'stock'];

    public function purchases() {
        return $this->hasMany(Purchase::class,'extinguisher_id','extinguisher_id');
    }
}