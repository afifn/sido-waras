<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Orders extends Model
{
    use SoftDeletes, HasFactory, LogsActivity;
    
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'order_date', 'status', 'total_amount'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_items()
    {
        return $this->hasMany(Order_items::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logExcept(['updated_at'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }
}
