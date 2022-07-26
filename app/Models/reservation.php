<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RReservation extends Model
{
    use HasFactory;
    protected $table = 'Reservations';
    protected $fillable =["first_name","last_name","email","phone","daty","ora","number_person"];
}
