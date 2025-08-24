<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the products.
     * Supports filtering, sorting, and pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Search by name
        if ($request->filled('q')) {
            $query->search($request->q);
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->category($request->category);
        }
        
        // Filter by price range
        if ($request->filled('min_price')) {
            $query->priceMin($request->min_price);
        }
        
        if ($request->filled('max_price')) {
            $query->priceMax($request->max_price);
        }
        
        // Sorting
        $sortColumn = $request->input('sort', 'created_at');
        $sortDirection = $request->input('dir', 'desc');
        $query->sortBy($sortColumn, $sortDirection);
        
        // Paginate results
        $perPage = $request->input('per_page', 10);
        $products = $query->paginate($perPage)->withQueryString();
        
        return response()->json($products);
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }
}