<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'resource', 'allow'
    ];
}
