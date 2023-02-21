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
        'sub_status',
        'remark',
        'status_json',  
        'attachments',
        'addedby',
    ];
    public function payments()
    {
        return $this->hasMany(Payment::class,'id','statusid')->orderby('created_at', 'desc');
    }

}
