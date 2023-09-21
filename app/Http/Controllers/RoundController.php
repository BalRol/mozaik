<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Round;

class RoundController extends Controller
{
    public function index()
    {
        $rounds = Round::all();
        return response()->json($rounds);
    }
/*
    public function create()
    {
        return view('rounds.create');
    }

    public function store(Request $request)
    {
        // Logika a forduló létrehozásához
    }

    public function show($id)
    {
        $round = Round::findOrFail($id);
        return view('rounds.show', compact('round'));
    }

    public function edit($id)
    {
        $round = Round::findOrFail($id);
        return view('rounds.edit', compact('round'));
    }

    public function update(Request $request, $id)
    {
        // Logika a forduló frissítéséhez
    }

    public function destroy($id)
    {
        // Logika a forduló törléséhez
    }
    */
}
