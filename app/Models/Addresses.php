<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Addresses extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'address', 'city', 'state', 'district', 'postal_code', 'is_default'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'address', 'city', 'state', 'district', 'postal_code', 'is_default'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Addresses');
    }
}
