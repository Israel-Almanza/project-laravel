<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Http\Requests\PaisRequest;

/**
 * Class PaisController
 * @package App\Http\Controllers
 */
class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pais = Pais::paginate();

        return view('pais.index', compact('pais'))
            ->with('i', (request()->input('page', 1) - 1) * $pais->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pais = new Pais();
        return view('pais.create', compact('pais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaisRequest $request)
    {
        Pais::create($request->validated());

        return redirect()->route('pais.index')
            ->with('success', 'Pais created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pais = Pais::find($id);

        return view('pais.show', compact('pais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pais = Pais::find($id);

        return view('pais.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaisRequest $request, Pais $pai)
    {
        $pai->update($request->validated());

        return redirect()->route('pais.index')
            ->with('success', 'Pais updated successfully');
    }

    public function destroy($id)
    {
        Pais::find($id)->delete();

        return redirect()->route('pais.index')
            ->with('success', 'Pais deleted successfully');
    }
}
