<?php

namespace App\Models;

use App\Models\Color;
use App\Models\clothingproduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColorProduct extends Model
{ 
    use HasFactory;
    protected $table = 'color_products';
    protected $fillable = ['color_id', 'product_id', 'image'];

    public function product()
    {
        return $this->belongsTo(clothingproduct::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id'); 
    }

}
