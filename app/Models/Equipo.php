<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $table = 'equipos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['articulo_id', 'cpu', 'ram', 'disco_duro', 'sistema_operativo', 'serial', 'id_periferico'];

    public function articulo()
    {
        return $this->morphOne(Articulo::class, 'articuloEspecifico');
    }

    public function perifericos()
    {
        return $this->belongsTo(Perifericos::class, 'id_periferico');
    }

}
