<?php

namespace App\Models;

use App\Models\size;
use App\Models\clothingproduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class relationsize extends Model
{
    use HasFactory;
    protected $fillable = ['size_id', 'amount', 'product_id'];

    public function size(){
        return $this->belongsTo(size::class);
    }

    public function product() {
        return $this->belongsTo(clothingproduct::class);
    }
}
