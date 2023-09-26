<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competitor;

class CompetitorController extends Controller
{
    public function index(Request $request){
        $id = $request->input('id');
        $competitors = Competitor::where('round_id', $id)->get();
        return response()->json($competitors);
    }
    public function create(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $id = $request->input('id');

        $competitor = new Competitor;
        $competitor->name = $name;
        $competitor->email = $email;
        $competitor->round_id = $id;
        $competitor->save();
        return response()->json(['message' => 'Sikeres'], 200);
    }

    public function destroy(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $id = $request->input('id');
        Competitor::where('name', $name)->where('email', $email)->where('round_id', $id)->delete();
        return response()->json(['message' => 'Sikeres'], 200);
    }
}
