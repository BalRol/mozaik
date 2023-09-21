<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competitor;

class CompetitorController extends Controller
{
    public function index()
    {
        $competitors = Competitor::all();
        return response()->json($competitors);
    }
/*
    public function create()
    {
        return view('competitors.create');
    }

    public function store(Request $request)
    {
        // Logika a versenyző létrehozásához
    }

    public function show($id)
    {
        $competitor = Competitor::findOrFail($id);
        return view('competitors.show', compact('competitor'));
    }

    public function edit($id)
    {
        $competitor = Competitor::findOrFail($id);
        return view('competitors.edit', compact('competitor'));
    }

    public function update(Request $request, $id)
    {
        // Logika a versenyző frissítéséhez
    }

    public function destroy($id)
    {
        // Logika a versenyző törléséhez
    }
    */
}
