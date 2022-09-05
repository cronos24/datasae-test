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

    public function rules()
    {
        return [
            'fecha' => 'required|date',
            'estado' => 'required|string|max:1',
        ];
    }

    public function messages()
    {
        return [
          'required' => 'El campo <strong> ":attribute" </strong> es obligatorio.',
          'max' => 'El campo <strong> ":attribute" </strong> excede el tamaño maximo permitido.',
          'date' => 'El campo <strong> ":attribute" </strong> no tiene un formato de fecha valido.',
        ];
    }

    public function attributes()
    {
        return [
            'fecha' => 'Fecha',
            'estado' => 'Estado'
        ];
    }


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
