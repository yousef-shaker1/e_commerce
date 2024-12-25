<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_Image_Admin extends Model
{
    use HasFactory;
    protected $table = 'product_image_admins';
    protected $fillable = ['product_id', 'image'];

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
