<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validation la alb el Array (items)
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);

        try {
            // Transaction: ya el kel bi-sir ya wala shi bi-sir
            return DB::transaction(function () use ($request) {
                $totalOrderPrice = 0;
                $orderItems = [];

                foreach ($request->items as $item) {
                    $product = Product::lockForUpdate()->find($item['product_id']);

                    // 2. Check Stock
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Sorry, Product '{$product->name}' only has {$product->stock} items left.");
                    }

                    // 3. Update Stock
                    $product->decrement('stock', $item['quantity']);

                    // 4. Jehhiz el data lal order
                    $totalPrice = $product->price * $item['quantity'];
                    $totalOrderPrice += $totalPrice;

                    // Iza 3andak table esmo order_items (optional) 
                    // Bas halla2 ra7 n-khallik t-khla2 order 3ade hasab el model taba3ak
                    $order = Order::create([
                        'user_id'    => Auth::id(),
                        'product_id' => $product->id,
                        'quantity'   => $item['quantity'],
                        'total_price'=> $totalPrice,
                    ]);
                    
                    $orderItems[] = $order;
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Order placed successfully!',
                    'orders' => $orderItems
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}