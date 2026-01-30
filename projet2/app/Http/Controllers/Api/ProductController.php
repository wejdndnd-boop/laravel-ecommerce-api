<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Get All Products (Pagination + Search + Resource)
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->paginate(10);
        
        // Sta3malna el Resource krmal n-nazem el JSON output
        return ProductResource::collection($products);
    }

    // 2. Create Product (Admin Only - Sta3malna StoreProductRequest)
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        
        return (new ProductResource($product))
            ->additional(['message' => 'Product created successfully'])
            ->response()
            ->setStatusCode(201); // Proper HTTP Status Code
    }

    // 3. Update Product (Admin Only - Sta3malna UpdateProductRequest)
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return (new ProductResource($product))
            ->additional(['message' => 'Product updated successfully']);
    }

    // 4. Delete Product
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    // 5. Show Single Product
    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}