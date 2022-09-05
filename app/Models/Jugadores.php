<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Jugadore
 *
 * @property $id
 * @property $n_documento
 * @property $nombres
 * @property $apellidos
 * @property $telefono
 * @property $dinero
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Apuesta[] $apuestas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Jugadores extends Model
{
    

    public function rules()
    {
        return [
            'n_documento' => 'required|integer',
            'nombres' => 'required|string|max:60',
            'apellidos' => 'required|string|max:60',
            'telefono' => 'required|integer',
            'dinero' => 'required|numeric',
            'estado' => 'required|max:1',
        ];
    }

    public function messages()
    {
        return [
          'integer' => 'El campo <strong> ":attribute" </strong> debe ser un entero.',
          'required' => 'El campo <strong> ":attribute" </strong> es obligatorio.',
          'numeric' => 'El campo <strong> ":attribute" </strong> debe ser numerico.',
          'integer' => 'El campo <strong> ":attribute" </strong> debe ser un numero entero.',
          'max' => 'El campo <strong> ":attribute" </strong> excede el tamaño maximo permitido.',
        ];
    }

    public function attributes()
    {
        return [
            'n_documento' => 'Numero de Documento',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'dinero' => 'Dinero',
            'estado' => 'Estado',
        ];
    }



    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['n_documento','nombres','apellidos','telefono','dinero','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apuestas()
    {
        return $this->hasMany('App\Models\Apuesta', 'jugadores_id', 'id');
    }
    

}
