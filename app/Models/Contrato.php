<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    public function servicios(){
        return $this->belongsToMany(Servicio::class)->withPivot(["cantidad"])->withTimestamps();
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
