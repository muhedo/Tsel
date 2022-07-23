<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dls extends Model
{
    use HasFactory;
    protected $table = "table_dls";
    protected $primaryKey = "id_dls";
    protected $keyType = "string";
    public $incrementing = false;
    protected $guarded = ['id_dls']; 
}
