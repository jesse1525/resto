<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    protected $table = 'Menus';
    protected $fillable =["name"];
    public function Items(){
        return $this->belongsToMany(Item::class);
    }
}
