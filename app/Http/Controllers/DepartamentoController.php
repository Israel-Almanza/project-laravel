<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Http\Requests\DepartamentoRequest;

/**
 * Class DepartamentoController
 * @package App\Http\Controllers
 */
class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::paginate();

        return view('departamento.index', compact('departamentos'))
            ->with('i', (request()->input('page', 1) - 1) * $departamentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departamento = new Departamento();
        return view('departamento.create', compact('departamento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartamentoRequest $request)
    {
        Departamento::create($request->validated());

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $departamento = Departamento::find($id);

        return view('departamento.show', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departamento = Departamento::find($id);

        return view('departamento.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartamentoRequest $request, Departamento $departamento)
    {
        $departamento->update($request->validated());

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento updated successfully');
    }

    public function destroy($id)
    {
        Departamento::find($id)->delete();

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento deleted successfully');
    }
}
