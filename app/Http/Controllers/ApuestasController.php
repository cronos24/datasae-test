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
        

            $_apuestas_color= [];
            $_porcentaje_color= [];
            $_acumulado= [];
            $probabilidad_acumulada= 0;
            foreach ($colors as $key => $value2) {
                $probabilidad = ($value2['probabilidad']/100);
                $probabilidad_acumulada+= $probabilidad;
                array_push($_apuestas_color,['id'=>$value2['id'],'color'=>$value2['color']]);
                array_push($_porcentaje_color,$probabilidad);
                array_push($_acumulado,$probabilidad_acumulada);
                
            }
       
            $rnd = rand(0,100);
            $numero= $rnd/100;

            $indice_ganador= 0;
            foreach ($_acumulado as $key3 => $value3) {
                if ($value3>$numero) {
                    if ($key3!=0) {
                        $indice_ganador= rand(1,2);
                    }else{
                        $indice_ganador= $key3;
                    }
                
                    break;
                }
            }
           

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
            'colores_id' => $_apuestas_color[$indice_ganador]['id'],
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
