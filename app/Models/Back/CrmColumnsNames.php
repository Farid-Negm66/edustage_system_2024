<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmColumnsNames extends Model
{
    protected $table = 'crm_columns_names';
    protected $fillable = ['category', 'order', 'status', 'name_ar'];
}
