<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Apuesta
 *
 * @property $id
 * @property $ruleta_id
 * @property $valor
 * @property $jugadores_id
 * @property $colores_id
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Colore $colore
 * @property Jugadore $jugadore
 * @property Ruletum $ruletum
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Apuestas extends Model
{
    
    static $rules = [
		'ruleta_id' => 'required',
		'valor' => 'required',
		'jugadores_id' => 'required',
		'colores_id' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ruleta_id','valor','jugadores_id','colores_id','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function colore()
    {
        return $this->hasOne('App\Models\Colore', 'id', 'colores_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jugadore()
    {
        return $this->hasOne('App\Models\Jugadore', 'id', 'jugadores_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ruletum()
    {
        return $this->hasOne('App\Models\Ruletum', 'id', 'ruleta_id');
    }
    

}
