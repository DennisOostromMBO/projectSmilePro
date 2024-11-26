<?php

namespace App\Http\Controllers;

use App\Models\Factuur;
use Illuminate\Http\Request;

class FactuurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factuur = Factuur::all();
        return view('factuur.index', compact('factuur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $factuur = Factuur::findOrFail($id);
        return view('factuur.details', compact('factuur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factuur $factuur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factuur $factuur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factuur $factuur)
    {
        //
    }
}
