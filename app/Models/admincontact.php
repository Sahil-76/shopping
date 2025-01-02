<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admincontact extends Model
{
    use HasFactory;

    protected $table = 'admincontacts';

    protected $fillable = [
        'email', 'phone_number', 'address',
    ];
}
