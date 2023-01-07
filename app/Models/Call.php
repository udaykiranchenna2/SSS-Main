<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;
    protected $fillable = [
        'requestdate',
        'requestno',
        'customerid',
        'calltype',
        'brand',
        'description',
        'productcategory',
        'status',
        'addedby',
    ];
    public function customer()
    {
        return $this->belongsTo(customer::class,'customerid','customerid');
    }
    public function statuses()
    {
        return $this->hasMany(CallStatus::class,'callid','requestno');
    }
    public function assignees()
    {
        return $this->hasMany(CallAssign::class,'callid','requestno')->orderBy('created_at','desc');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'addedby','id');
    }
}
