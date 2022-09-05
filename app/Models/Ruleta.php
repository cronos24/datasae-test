<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ruletum
 *
 * @property $id
 * @property $fecha
 * @property $valor_apostado
 * @property $valor_pagado
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Apuesta[] $apuestas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ruleta extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','valor_apostado','valor_pagado','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apuestas()
    {
        return $this->hasMany('App\Models\Apuesta', 'ruleta_id', 'id');
    }
    

}
