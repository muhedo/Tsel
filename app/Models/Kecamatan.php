<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = "table_kecamatan";
    protected $primaryKey = "id_kecamatan";
    protected $keyType = "string";
    public $incrementing = false;
    protected $guarded = ['id_kecamatan']; 
}
