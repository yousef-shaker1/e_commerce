<?php

namespace App\Models;

use App\Models\clothingsection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class clothingproduct extends Model
{
    use HasFactory;
    protected $fillable = ['name','img', 'description', 'price', 'type','section_id'];

    public function section(){
        return $this->belongsTo(clothingsection::class);
    }

}
