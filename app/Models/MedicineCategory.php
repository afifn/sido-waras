<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineCategory extends Model
{
    protected $table = 'medicine_category';
    protected $fillable = [
        'medicine_id',
        'category_id',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
