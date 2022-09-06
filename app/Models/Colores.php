<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Colores extends Model
{
    
    

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['color','probabilidad','recompensa','estado'];


    public function apuestas()
    {
        return $this->hasMany('App\Models\Apuesta', 'colores_id', 'id');
    }
    

}
