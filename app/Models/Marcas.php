<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;

    protected $table = 'marcas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre_marca'];

    public function perifericos()
    {
        return $this->hasMany(Perifericos::class, 'id_marca');
    }

    public function articulo()
    {
        return $this->hasMany(Articulo::class, 'id_marca');
    }
}
