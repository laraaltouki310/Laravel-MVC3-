<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $products = $user->products; 

        return response()->json([
            'user' => $user,
            'products' => $products
        ]);
    }
}
