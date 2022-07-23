<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;
    protected $table = "table_cluster";
    protected $primaryKey = "id_cluster";
    protected $keyType = "string";
    public $incrementing = false;
    protected $guarded = ['id_cluster']; 
}
