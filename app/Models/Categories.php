<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Categories extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];
    protected $hidden = ['created_at', 'updated_at'];

    public function medicines()
    {
        return $this->belongsToMany(Medicines::class, 'medicine_category', 'category_id', 'medicine_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description']);
    }
}
