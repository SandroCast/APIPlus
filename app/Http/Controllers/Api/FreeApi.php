<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Pix;
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

    public function consultaPix(Request $request)
    {
        return response()->json(Pix::where('pedido', $request->pedido)->where('pix', $request->pix)->exists(), 201);
    }

    public function confirmaPix(Request $request)
    {
        Pix::create($request->all());
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
