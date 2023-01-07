<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'callid',
        'status',
        'type',
        'mode',
        'level',
        'visitdate',
        'addedby',
    ];
}
