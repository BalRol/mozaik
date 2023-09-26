<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;

class CompetitionController extends Controller
{
    public function index(){
        $competitions = Competition::all();
        return response()->json($competitions);
    }
    public function create(Request $request){
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

    public function destroy(Request $request){
        $name = $request->input('name');
        $year = $request->input('year');
        Competition::where('name', $name)->where('year', $year)->delete();
        return response()->json(['message' => 'Sikeres'], 200);
    }
}
