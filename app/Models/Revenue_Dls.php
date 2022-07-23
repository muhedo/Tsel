<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue_Dls extends Model
{
    use HasFactory;
    protected $table = "table_revenue_cluster";
    protected $primaryKey = "id_revenue";
    protected $keyType = "string";
    public $incrementing = false;
    protected $guarded = ['id_revenue']; 
}
