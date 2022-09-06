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
    public function color()
    {
        return $this->hasOne('App\Models\Colores', 'id', 'colores_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jugador()
    {
        return $this->hasOne('App\Models\Jugadores', 'id', 'jugadores_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ruleta()
    {
        return $this->hasOne('App\Models\Ruletum', 'id', 'ruleta_id');
    }
    

}
