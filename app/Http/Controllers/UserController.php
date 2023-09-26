<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Competitor;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }
}
