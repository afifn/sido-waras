<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Payments extends Model
{
    use HasFactory, LogsActivity;
    
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'payment_method', 'payment_type', 'amount', 'payment_date', 'status', 'gateway_response', 'transaction_code'];
    protected $hidden = ['created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logExcept(['updated_at'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

}
