<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Get all categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $categories = Category::pagiante(15);
        return response()->json($categories);
    }
}
