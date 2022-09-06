<?php

namespace App\Http\Controllers;

use App\Models\Ruleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\SpinRouletteEvent;
use App\Models\Colores;
use App\Models\Apuestas;
/**
 * Class RuletumController
 * @package App\Http\Controllers
 */
class RuletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruletas = Ruleta::all()->toArray();  
        return view('ruleta.index',['ruletas'=> array_reverse($ruletas)]);
    }

    public function refresh()
    {
       
        $ruletas = Ruleta::all()->toArray();  
        return response()->json(array_reverse($ruletas));
    }

    public function winner($id)
    {

        $colors = Colores::all()->where('estado', 'A')->toArray();

        
        $_apuestas_color= [];
        $_porcentaje_color= [];
        $_acumulado= [];
        $probabilidad_acumulada= 0;
        foreach ($colors as $key => $value) {
            $probabilidad = ($value['probabilidad']/100);
            $probabilidad_acumulada+= $probabilidad;
            array_push($_apuestas_color,$value['color']);
            array_push($_porcentaje_color,$probabilidad);
            array_push($_acumulado,$probabilidad_acumulada);
            
        }
        $rnd = rand(0,100);
        $numero= $rnd/100;

        $indice_ganador= 0;
        foreach ($_acumulado as $key => $value) {
            if ($value>$numero) {
                if ($key!=0) {
                    $indice_ganador= rand(1,2);
                }else{
                    $indice_ganador= $key;
                }
               
                break;
            }
        }


      
        $apuestas = Apuestas::with('color')->where('ruleta_id',$id)->whereRelation('color', 'color', $_apuestas_color[$indice_ganador])->get();   

        $valor_premios=0;
        foreach ($apuestas as $key => $value) {
            $valor_premios+=$value->valor;
            $model_apuesta = Apuestas::findOrFail($value->id);
            $model_apuesta->fill(['estado'=>'G']);
            $model_apuesta->save();      
        }

        $model_ruleta = Ruleta::findOrFail($id);
        $model_ruleta->fill(['valor_pagado'=>$valor_premios]);
        $model_ruleta->save();  
 
        
    } 

    function randomAlpha() {
        srand(time());
        $rnd = rand(0,100);
        return $rnd/100;
     }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  

        $validator=Validator::make($request->all(),Ruleta::rules(),Ruleta::messages(),Ruleta::attributes());
        
        if($validator->fails())
        {
                $response['status'] = 'fail';
                $response['response'] = $validator->errors();
        }else{   

                $response['status'] = 'success';
                $response['response'] = Ruleta::create($request->all());
                event(new SpinRouletteEvent());               
                
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruleta= Ruleta::find($id);

        return response()->json($ruleta);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ruletum $ruletum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

     
        $validator=Ruleta::make($request->all(),Ruleta::rules(),Ruleta::messages(),Ruleta::attributes());
        
        if($validator->fails())
        {
                $response['status'] = 'fail';
                $response['response'] = $validator->errors();
        }else{                
                $response['status'] = 'success';
                $response['response'] = Ruleta::find($id)->update($request->all());
                event(new SpinRouletteEvent());
        }

        return response()->json($response);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $delete= Ruleta::find($id)->delete();
        event(new SpinRouletteEvent());
        return  $delete;
    }
}
