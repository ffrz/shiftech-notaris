<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'active', 'name', 'phone', 'email', 'address', 'notes',
    ];
}
