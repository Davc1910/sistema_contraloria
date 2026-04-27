<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;
    protected $table = 'personas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre', 'apellido', 'cedula','email', 'telefono' ,'id_oficina'];

    public function oficina()
    {
        return $this->belongsTo(Oficinas::class, 'id_oficina');
    }

}
