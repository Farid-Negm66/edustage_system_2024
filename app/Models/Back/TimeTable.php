<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $table = 'time_tables';
    protected $fillable = [
        'group_id', 'notes', 'day', 'date', 'class_type', 'times', 'room_id', 'user', 'group_to_colspan', 'user_add', 'user_edit'
    ];
}
