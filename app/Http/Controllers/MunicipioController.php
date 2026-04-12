<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Http\Requests\MunicipioRequest;

/**
 * Class MunicipioController
 * @package App\Http\Controllers
 */
class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipios = Municipio::paginate();

        return view('municipio.index', compact('municipios'))
            ->with('i', (request()->input('page', 1) - 1) * $municipios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipio = new Municipio();
        return view('municipio.create', compact('municipio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MunicipioRequest $request)
    {
        Municipio::create($request->validated());

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $municipio = Municipio::find($id);

        return view('municipio.show', compact('municipio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $municipio = Municipio::find($id);

        return view('municipio.edit', compact('municipio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MunicipioRequest $request, Municipio $municipio)
    {
        $municipio->update($request->validated());

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio updated successfully');
    }

    public function destroy($id)
    {
        Municipio::find($id)->delete();

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio deleted successfully');
    }
}
