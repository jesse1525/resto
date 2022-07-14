<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $table = 'Items';
    protected $fillable =["title","description","price","category_id"];
    public function Menus(){
        return $this->belongsToMany(Menu::class);
    }
    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
