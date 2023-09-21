<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::all();
        return response()->json($competitions);
    }
/*
    public function create()
    {
        return view('competitions.create');
    }

    public function store(Request $request)
    {
        // Logika a verseny létrehozásához
    }

    public function show($name, $year)
    {
        $competition = Competition::findOrFail([$name, $year]);
        return view('competitions.show', compact('competition'));
    }

    public function edit($name, $year)
    {
        $competition = Competition::findOrFail([$name, $year]);
        return view('competitions.edit', compact('competition'));
    }

    public function update(Request $request, $name, $year)
    {
        // Logika a verseny frissítéséhez
    }

    public function destroy($name, $year)
    {
        // Logika a verseny törléséhez
    }
    */
}
