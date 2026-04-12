<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Http\Requests\ProvinciaRequest;

/**
 * Class ProvinciaController
 * @package App\Http\Controllers
 */
class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provincias = Provincia::paginate();

        return view('provincia.index', compact('provincias'))
            ->with('i', (request()->input('page', 1) - 1) * $provincias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provincia = new Provincia();
        return view('provincia.create', compact('provincia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProvinciaRequest $request)
    {
        Provincia::create($request->validated());

        return redirect()->route('provincias.index')
            ->with('success', 'Provincia created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $provincia = Provincia::find($id);

        return view('provincia.show', compact('provincia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $provincia = Provincia::find($id);

        return view('provincia.edit', compact('provincia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProvinciaRequest $request, Provincia $provincia)
    {
        $provincia->update($request->validated());

        return redirect()->route('provincias.index')
            ->with('success', 'Provincia updated successfully');
    }

    public function destroy($id)
    {
        Provincia::find($id)->delete();

        return redirect()->route('provincias.index')
            ->with('success', 'Provincia deleted successfully');
    }
}
