<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'customerid',
        'address',
        'city',
        'state',
        'country',
        'area',
        'pincode',
        'mobile1',
        'mobile2',
        'addedby',
    ];
}
