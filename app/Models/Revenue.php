<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $table = "table_revenue";
    protected $primaryKey = "id_revenue";
    protected $keyType = "string";
    public $incrementing = false;
    protected $guarded = ['id_revenue']; 
    public $timestamps = false;
}
