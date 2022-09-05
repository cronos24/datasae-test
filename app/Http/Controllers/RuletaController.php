<?php

namespace App\Http\Controllers;

use App\Models\Ruleta;
use Illuminate\Http\Request;
use App\Events\SpinRouletteEvent;
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
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        $validator=Ruleta::make($request->all(),Ruleta::rules(),Ruleta::messages(),Ruleta::attributes());
        
        if($validator->fails())
        {
                $response['status'] = 'fail';
                $response['response'] = $validator->errors();
        }else{   

                $response['status'] = 'success';
                $response['response'] = Ruleta::create($request->all());
                event(new SpinRouletteEvent());               
                
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
