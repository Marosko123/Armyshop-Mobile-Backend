<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\User;

class BasketsController extends Controller
{
    public function getByUserId(Request $request, $user_id)
    {
        // find user with the user id
        $user = User::find($user_id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found'
            ]);
        }

        // Retrieve all products in the user's basket
        $products = Product::join('baskets', 'products.id', '=', 'baskets.product_id')
            ->where('baskets.user_id', $user->id)
            ->get();

        // Return the products
        if ($products->isEmpty()) {
            return response()->json([
                'user' => $user,
                'products' => 'The basket is empty.',
            ]);
        } else {
            return response()->json([
                'user' => $user,
                'products' => $products,
            ]);
        }



    }
}