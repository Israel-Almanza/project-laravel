<?php

namespace App\Http\Controllers;

use App\Models\Jerarquia;
use App\Http\Requests\JerarquiaRequest;

/**
 * Class JerarquiaController
 * @package App\Http\Controllers
 */
class JerarquiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jerarquias = Jerarquia::paginate();

        return view('jerarquia.index', compact('jerarquias'))
            ->with('i', (request()->input('page', 1) - 1) * $jerarquias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jerarquia = new Jerarquia();
        return view('jerarquia.create', compact('jerarquia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JerarquiaRequest $request)
    {
        Jerarquia::create($request->validated());

        return redirect()->route('jerarquias.index')
            ->with('success', 'Jerarquia created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jerarquia = Jerarquia::find($id);

        return view('jerarquia.show', compact('jerarquia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jerarquia = Jerarquia::find($id);

        return view('jerarquia.edit', compact('jerarquia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JerarquiaRequest $request, Jerarquia $jerarquia)
    {
        $jerarquia->update($request->validated());

        return redirect()->route('jerarquias.index')
            ->with('success', 'Jerarquia updated successfully');
    }

    public function destroy($id)
    {
        Jerarquia::find($id)->delete();

        return redirect()->route('jerarquias.index')
            ->with('success', 'Jerarquia deleted successfully');
    }
}
