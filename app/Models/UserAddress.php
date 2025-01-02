<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table='user_addresses';
    protected $fillable = [
        'user_id',
        'house_no',
        'city',
        'pin_code',
        'state',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
