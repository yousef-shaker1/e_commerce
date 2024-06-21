<?php

namespace App\Models;

use App\Models\size;
use App\Models\clothingproduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class clothesbasket extends Model
{
    use HasFactory;
    protected $guarded= [];
    public function customer(){
        return $this->belongsTo(customer::class);
    }
    
    public function size(){
        return $this->belongsTo(size::class);
    }

    public function product() {
        return $this->belongsTo(clothingproduct::class);
    }
}
