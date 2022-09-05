<?php

namespace App\Http\Controllers;

use App\Models\Apuestas;
use Illuminate\Http\Request;

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
    public function index()
    {
        $apuestas = Apuestas::paginate();

        return view('apuesta.index', compact('apuestas'))
            ->with('i', (request()->input('page', 1) - 1) * $apuestas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apuesta = new Apuestas();
        return view('apuesta.create', compact('apuesta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Apuestas::$rules);

        $apuesta = Apuestas::create($request->all());

        return redirect()->route('apuestas.index')
            ->with('success', 'Apuesta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apuesta = Apuestas::find($id);

        return view('apuesta.show', compact('apuesta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apuesta = Apuestas::find($id);

        return view('apuesta.edit', compact('apuesta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Apuesta $apuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apuestas $apuesta)
    {
        request()->validate(Apuestas::$rules);

        $apuesta->update($request->all());

        return redirect()->route('apuestas.index')
            ->with('success', 'Apuesta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $apuesta = Apuestas::find($id)->delete();

        return redirect()->route('apuestas.index')
            ->with('success', 'Apuesta deleted successfully');
    }
}
