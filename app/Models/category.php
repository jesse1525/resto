<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'Categories';
    protected $fillable =["name"];
    public function item(){
        return $this->hasMany(Item::class);
    }
}
