<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Exception;

class CartController extends Controller
{
    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity'   => 'required|integer|min:1',
            ]);

            $user = auth()->user();
            $product = Product::find($request->product_id);
            $cart = Cart::firstOrCreate(
                ['user_id' => $user->id, 'status' => 'open'],
                ['total_amount' => 0, 'checked_out_at' => null]
            );

            $existingItem = CartItem::where('cart_id', $cart->id)
                                    ->where('product_id', $product->id)
                                    ->first();

            if ($existingItem) {

                $existingItem->quantity += $request->quantity;
                $existingItem->line_total = $existingItem->quantity * $product->price;
                $existingItem->save();

            } else {

                CartItem::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                    'user_id'    => $user->id,
                    'quantity'   => $request->quantity,
                    'unit_price' => $product->price,
                    'line_total' => $product->price * $request->quantity,
                ]);
            }

            $cart->total_amount = CartItem::where('cart_id', $cart->id)->sum('line_total');
            $cart->save();

            return response()->json([
                'message'     => 'Product added to cart',
                'cart_total'  => $cart->total_amount,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error'     => 'Something went wrong',
                'details'   => $e->getMessage(),
            ], 500);
        }
    }
}