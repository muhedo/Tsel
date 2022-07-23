<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = "table_kota";
    protected $primaryKey = "id_kota";
    protected $keyType = "string";
    public $incrementing = false;
    protected $guarded = ['id_kota']; 
}
