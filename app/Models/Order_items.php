<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_items extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'medicine_id', 'quantity', 'price'];
    protected $hidden = ['created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
