<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    use HasFactory;

    protected $table = 'prescriptions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'medicine_id',
        'prescription_image',
        'prescription_date',
        'status',
        'notes',
        'quantity',
    ];
}
