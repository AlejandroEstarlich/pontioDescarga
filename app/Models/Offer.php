<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';

    // Relación Many to One Instalador -> Solicitud: Un instalador puede tener muchas ofertas
    public function user(){
    	return $this->belongsTo('App\Models\User','installer_id')
    }
}
