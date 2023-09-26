<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competitor;

/**
 * A CompetitorController osztály kezeli a versenyzőkkel kapcsolatos műveleteket.
 */
class CompetitorController extends Controller
{
    /**
     * Visszaadja az összes versenyzőt JSON formátumban egy adott kör alapján.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $competitors = Competitor::where('round_id', $id)->get();
        return response()->json($competitors);
    }

    /**
     * Létrehoz egy új versenyzőt a megadott adatokkal.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $id = $request->input('round_id');

        $competitor = new Competitor;
        $competitor->name = $name;
        $competitor->email = $email;
        $competitor->round_id = $id;
        $competitor->save();
        return response()->json(['message' => 'Sikeres'], 200);
    }

    /**
     * Törli a versenyzőt a megadott név, e-mail és kör alapján.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $id = $request->input('round_id');
        Competitor::where('name', $name)->where('email', $email)->where('round_id', $id)->delete();
        return response()->json(['message' => 'Sikeres'], 200);
    }
}
