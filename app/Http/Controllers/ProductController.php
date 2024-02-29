<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Get all products with pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        try {
            $products = Product::paginate(15); // Paginación con un límite de 15 productos por página
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch products: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Search products by name with pagination.
     *
     * @param  string  $text
     * @return \Illuminate\Http\Response
     */
    public function search($text)
    {
        try {
            $products = Product::where('name', 'like', '%' . $text . '%')->paginate(15); // Paginación con un límite de 15 productos por página
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to search products: ' . $e->getMessage()], 500);
        }
    }
}
