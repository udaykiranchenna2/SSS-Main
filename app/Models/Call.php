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
        'files',
    ];
    public function customer()
    {
        return $this->belongsTo(customer::class,'customerid','customerid');
    }
    public function statuses()
    {
        return $this->hasMany(CallStatus::class,'callid','requestno')->orderby('created_at', 'desc');
    }
    public function assignees()
    {
        return $this->hasMany(CallAssign::class,'callid','requestno')->orderBy('created_at','desc');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'addedby','id');
    }
    public function paymentdata()
    {
        return $this->hasOne(Payment::class,'callid','requestno')->orderby('created_at', 'desc');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class,'callid','requestno')->where('paymentStatus', 'Due')->orderby('created_at', 'desc');
    }
}
