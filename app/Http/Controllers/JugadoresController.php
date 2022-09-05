<?php

namespace App\Http\Controllers;

use App\Models\Jugadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\JugadoresEvent;
/**
 * Class JugadoresController
 * @package App\Http\Controllers
 */
class JugadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jugadores = Jugadores::all()->toArray();  
        return view('jugadores.index',['jugadores'=> array_reverse($jugadores)]);
    }

    public function refresh()
    {
       
        $jugadores = Jugadores::all()->toArray();  
        return response()->json(array_reverse($jugadores));
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['estado' => 'A']);
        $validator=Validator::make($request->all(),Jugadores::rules(),Jugadores::messages(),Jugadores::attributes());
        
        if($validator->fails())
        {
                $response['status'] = 'fail';
                $response['response'] = $validator->errors();
        }else{   
            $_jugador = Jugadores::where('n_documento', '=', $request->n_documento)->exists();           
        
                if ($_jugador) {
                    $response['status'] = 'fail';
                    $response['response'] = ['n_documento'=>["El numero de documento ya esta registrado"]];
                } else{
                    $response['status'] = 'success';
                    $response['response'] = Jugadores::create($request->all());
                    event(new JugadoresEvent());
                }
                
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jugadores = Jugadores::find($id);

        return response()->json($jugadores);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Jugadore $jugadore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

     
        $validator=Validator::make($request->all(),Jugadores::rules(),Jugadores::messages(),Jugadores::attributes());
        
        if($validator->fails())
        {
                $response['status'] = 'fail';
                $response['response'] = $validator->errors();
        }else{                
                $response['status'] = 'success';
                $response['response'] = Jugadores::find($id)->update($request->all());
                event(new JugadoresEvent());
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
        $delete= Jugadores::find($id)->delete();
        event(new JugadoresEvent());
        return  $delete;
       
        
    }
}
