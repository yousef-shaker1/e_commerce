<?php

namespace App\Models;

use App\Models\clothingproduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class clothingorder extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'day', 'product_id','count', 'size', 'status'];
    public function customer(){
        return $this->belongsTo(customer::class);
    }
    public function product(){
        return $this->belongsTo(clothingproduct::class);
    }
}
