<?php

namespace App\Models;

use App\Models\section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'img', 'description', 'price', 'amount', 'section_id'];
    public function section(){
        return $this->belongsTo(section::class);
    }
}
