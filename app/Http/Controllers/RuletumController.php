<?php

namespace App\Http\Controllers;

use App\Models\Ruletum;
use Illuminate\Http\Request;

/**
 * Class RuletumController
 * @package App\Http\Controllers
 */
class RuletumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruleta = Ruletum::paginate();

        return view('ruletum.index', compact('ruleta'))
            ->with('i', (request()->input('page', 1) - 1) * $ruleta->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ruletum = new Ruletum();
        return view('ruletum.create', compact('ruletum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ruletum::$rules);

        $ruletum = Ruletum::create($request->all());

        return redirect()->route('ruleta.index')
            ->with('success', 'Ruletum created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruletum = Ruletum::find($id);

        return view('ruletum.show', compact('ruletum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruletum = Ruletum::find($id);

        return view('ruletum.edit', compact('ruletum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ruletum $ruletum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruletum $ruletum)
    {
        request()->validate(Ruletum::$rules);

        $ruletum->update($request->all());

        return redirect()->route('ruleta.index')
            ->with('success', 'Ruletum updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ruletum = Ruletum::find($id)->delete();

        return redirect()->route('ruleta.index')
            ->with('success', 'Ruletum deleted successfully');
    }
}
