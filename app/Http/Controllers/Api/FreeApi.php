<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FreeApi extends Controller
{
    public function index()
    {
        // return Product::all();
        dd('ok');
    }

    public function salvar(Request $request)
    {
        // return response()->json(Product::create($request->all()), 201);
    }

    public function login(Request $request)
    {
        $credenciais = $request->only(['email', 'password']);

        if (Auth::attempt($credenciais) === false){
            return response()->json('Unauthorized', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('token');
        return response()->json($token->plainTextToken);
    }
}
