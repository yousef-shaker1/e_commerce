<?php

namespace App\Models;

use App\Models\size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color_Size extends Model
{
    use HasFactory;
    protected $table = 'color_sizes';

    protected $fillable=['color_product_id', 'size_id', 'amount', 'price'];

    public function color_product(){
        return $this->belongsTo(Color_product::class);
    }
    

    public function size()
    {
        return $this->belongsTo(size::class); 
    }
}
