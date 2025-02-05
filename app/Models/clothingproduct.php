<?php

namespace App\Models;

use App\Models\clothingsection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class clothingproduct extends Model
{
    use HasFactory;
    use HasTranslations;
    
    protected $fillable = ['name','img', 'description', 'price', 'type','section_id'];
    public $translatable = ['name', 'description', 'type'];

    public function section(){
        return $this->belongsTo(clothingsection::class);
    }

}
