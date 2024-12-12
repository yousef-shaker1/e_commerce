<?php

namespace App\Models;

use App\Models\product;
use App\Models\customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
    use HasFactory;
    protected $fillable= ['customer_id', 'day', 'product_id', 'count', 'status'];
    public function customer(){
        return $this->belongsTo(customer::class);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }
}
