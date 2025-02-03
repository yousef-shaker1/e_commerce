<?php

namespace App\Models;

use App\Models\section;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name', 'img', 'description', 'price', 'amount', 'section_id'];

    public $translatable = ['name', 'description'];
    

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];
    
    public function section(){
        return $this->belongsTo(section::class);
    }
}
