<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class section extends Model
{
    use HasFactory;
    use HasTranslations;
    
    public $translatable = ['name'];
    protected $fillable = ['name', 'img']; 

    protected $casts = [
        'name' => 'array',
    ];
}
