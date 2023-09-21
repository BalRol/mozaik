<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
/*
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Logika az új felhasználó létrehozásához
    }

    public function show($name, $email)
    {
        $user = User::findOrFail([$name, $email]);
        return view('users.show', compact('user'));
    }

    public function edit($name, $email)
    {
        $user = User::findOrFail([$name, $email]);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $name, $email)
    {
        // Logika a felhasználó frissítéséhez
    }

    public function destroy($name, $email)
    {
        // Logika a felhasználó törléséhez
    }
    */
}
