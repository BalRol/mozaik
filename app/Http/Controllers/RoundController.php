<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Round;

/**
 * A RoundController osztály kezeli a körökkel kapcsolatos műveleteket.
 */
class RoundController extends Controller
{
    /**
     * Visszaadja az összes kör JSON formátumban egy adott verseny alapján.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $year = $request->input('year');
        $rounds = Round::where('competition_name', $name)->where('competition_year', $year)->get();
        return response()->json($rounds);
    }

    /**
     * Létrehoz egy új kört a megadott adatokkal.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $name = $request->input('name');
        $location = $request->input('location');
        $date = $request->input('date');
        $competition_name = $request->input('competition_name');
        $competition_year = $request->input('competition_year');

        $round = new Round;
        $round->name = $name;
        $round->location = $location;
        $round->date = $date;
        $round->competition_name = $competition_name;
        $round->competition_year = $competition_year;
        $round->save();

        return response()->json(['message' => 'Sikeres'], 200);
    }

    /**
     * Törli a kört a megadott azonosító alapján.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Round::where('id', $id)->delete();
        return response()->json(['message' => 'Sikeres'], 200);
    }
}
