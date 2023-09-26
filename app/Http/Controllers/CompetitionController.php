<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;

/**
 * A CompetitionController osztály kezeli a versenyekkel kapcsolatos műveleteket.
 */
class CompetitionController extends Controller
{
    /**
     * Visszaadja az összes versenyt JSON formátumban.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $competitions = Competition::all();
        return response()->json($competitions);
    }

    /**
     * Létrehoz egy új versenyt a megadott adatokkal.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $name = $request->input('name');
        $year = $request->input('year');
        $location = $request->input('location');

        $competition = new Competition;
        $competition->name = $name;
        $competition->year = $year;
        $competition->location = $location;
        $competition->save();

        return response()->json(['message' => 'Sikeres'], 200);
    }

    /**
     * Törli a versenyt a megadott név és év alapján.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $name = $request->input('name');
        $year = $request->input('year');
        Competition::where('name', $name)->where('year', $year)->delete();
        return response()->json(['message' => 'Sikeres'], 200);
    }
}
