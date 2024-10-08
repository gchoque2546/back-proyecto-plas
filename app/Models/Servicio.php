<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use HasFactory, SoftDeletes;

    public function clase(){
        return $this->belongsTo(Clase::class);
    }
    public function contratos(){
        return $this->belongsToMany(Contrato::class)->withPivot(["cantidad"])->withTimestamps();
    }
}
