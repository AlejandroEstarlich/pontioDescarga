<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating';

    // Relación Many To One Usuario -> Rating: Un usuario puede tener varias valoraciones
    public function user(){
    	return $this->belongsTo('App\Models\User', 'to_user_id');
    }


}
