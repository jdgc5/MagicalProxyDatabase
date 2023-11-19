<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartas extends Model
{
    use HasFactory;
    
    protected $table = 'carta';
    
    protected $fillable = ['name','color','type','rarity','edition','year','image'];
}
