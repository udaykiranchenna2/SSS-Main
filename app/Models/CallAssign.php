<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallAssign extends Model
{
    use HasFactory;
    protected $fillable = [
        'callid',
        'userid',
        'assigneddate',
        'assignedActive',
        'level',
        'assignedby',
    ];
}
