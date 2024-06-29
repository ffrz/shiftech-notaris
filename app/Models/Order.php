<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    use HasFactory;

    const STATUS_OPEN = 0;
    const STATUS_CLOSED = 1;
    const STATUS_CANCELED = 2;

    protected static $_statuses = [
        self::STATUS_OPEN => 'Aktif',
        self::STATUS_CLOSED => 'Selesai',
        self::STATUS_CANCELED => 'Dibatalkan',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id', 'officer_id', 'service_id', 'partner_id',
        'deed_number', 'file_number', 'deed_properties',
        'date', 'closed_date', 'description', 'total', 'total_paid', 'notes', 'status'
    ];

    public function statusFormatted()
    {
        return self::$_statuses[$this->status];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
