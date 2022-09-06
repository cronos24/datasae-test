<?php

namespace App\Http\Controllers;

use App\Models\Apuestas;
use Illuminate\Http\Request;
use App\Models\Colores;
use App\Models\Jugadores;
use App\Models\Ruleta;
use App\Events\SpinRouletteEvent;
/**
 * Class ApuestaController
 * @package App\Http\Controllers
 */
class ApuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {     
        $apuestas =  Apuestas::with('color', 'jugador')->where('ruleta_id', $id)->get();       
        return response()->json($apuestas);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
        $colors = Colores::all()->where('estado', 'A')->toArray();
        $jugadores = Jugadores::all()->where('dinero', '>',0)->toArray(); 
        
        $total_apostado= 0;
        foreach ($jugadores as $key => $value) {
            $valor = 0;
            $rand_color= $colors[array_rand($colors)];

            if ($value['dinero']<=1000) {
                $valor= $value['dinero'];
            }else{
                $porcentaje = rand(8, 15);
                $valor= $value['dinero']*$porcentaje/100;
            }
           
            $model_apuesta= [
            'ruleta_id' => $request->ruleta_id,
            'valor' => $valor,
            'jugadores_id' => $value['id'],
            'colores_id' => $rand_color['id'],
            'estado' => 'A'
            ];

            $model = new Apuestas;
            $model->fill($model_apuesta);
            $saved = $model->save();

            if ($saved) {
                $model_jugadores = Jugadores::findOrFail($value['id']);
                $model_jugadores->fill(['dinero'=>($value['dinero']-$valor)]);
                $model_jugadores->save();

                $total_apostado += $valor;
            }

        }

        $model_ruleta = Ruleta::findOrFail($request->ruleta_id);
        $model_ruleta->fill(['valor_apostado'=>$total_apostado]);
        $model_ruleta->save();

        event(new SpinRouletteEvent());

        return $model_ruleta;
    }       


    
}
