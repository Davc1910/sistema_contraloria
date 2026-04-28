<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incorporar extends Model
{
    use HasFactory;
    protected $table = 'incorporars';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'id_asignacion',];

    // // Relaciones (si es necesario)
    public function asignaciones()
    {
        return $this->belongsTo(Asignaciones::class, 'id_asignacion');
    }
}
