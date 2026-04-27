<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    use HasFactory;
    protected $table = 'modelos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'nombre_modelo'];

    public function perifericos()
    {
        return $this->hasMany(Perifericos::class, 'id_modelo');
    }
}
