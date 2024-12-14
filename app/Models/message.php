<?php

namespace App\Models;

use App\Models\customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class message extends Model
{
    use HasFactory;
    protected $fillable=['message', 'customer_id'];
    public function customer(){
        return $this->belongsTo(customer::class);
    }
}
