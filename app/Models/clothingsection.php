<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class clothingsection extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $fillable = ['name','img'];
    public $translatable = ['name'];

    protected $casts = [
        'name' => 'array',
    ];
}

