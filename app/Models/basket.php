<?php

namespace App\Models;

use App\Models\product;
use App\Models\customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class basket extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','customer_id'];

    public function customer(){
        return $this->belongsTo(customer::class);
        }
    public function product(){
        return $this->belongsTo(product::class);
    }
}
