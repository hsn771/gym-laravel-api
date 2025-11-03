<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT * FROM categories");
        return response()->json($data);
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
         return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
       $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }


}