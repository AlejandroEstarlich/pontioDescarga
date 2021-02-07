<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'requests';

    // Relación One To Many Request -> Offers: Una solicitud puede tener muchas ofertas
    public function offers(){
    	return $this->hasMany('App\Models\Offer');
    }

    // Relación One To One Request -> User: Un usuario puede tener una solicitud a la vez
    public function user(){
    	return $this->hasOne('App\Models\User');
    }
}
