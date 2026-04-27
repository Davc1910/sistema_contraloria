<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobiliarios extends Model
{
    use HasFactory;
    protected $table = 'mobiliarios';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'tipo', 'serial'];

}
