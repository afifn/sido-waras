<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Medicines extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, LogsActivity, InteractsWithMedia;

    protected $table = 'medicines';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'price', 'stock_quantity'];
    protected $hidden = ['created_at', 'updated_at'];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'medicine_category', 'medicine_id', 'category_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'price', 'stock_quantity']);
    }
}
