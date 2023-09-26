<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

/**
 * A UserController osztály kezeli a felhasználókkal kapcsolatos műveleteket.
 */
class UserController extends Controller
{
    /**
     * Visszaadja az összes felhasználót JSON formátumban.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }
}
