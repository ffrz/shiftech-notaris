<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'username',
        'password',
        'is_active',
        'is_admin',
        'fullname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    protected $_acl = null;

    public function acl()
    {
        if ($this->_acl === null) {
            $this->_acl = [];
            $rows = UserAccess::get()->where('user_id', '=', $this->id);
            foreach ($rows as $row) {
                $this->_acl[$row->resource] = $row->allow;
            }
        }
        return $this->_acl;
    }

    public function canAccess($resource)
    {
        if ($this->is_admin) return true;
        $acl = $this->acl();
        return isset($acl[$resource]) && $acl[$resource] == true;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_datetime = current_datetime();
            $model->created_by_uid = Auth::user()->id;
            return true;
        });

        static::updating(function ($model) {
            $model->updated_datetime = current_datetime();
            $model->updated_by_uid = Auth::user()->id;
            return true;
        });
    }
}
