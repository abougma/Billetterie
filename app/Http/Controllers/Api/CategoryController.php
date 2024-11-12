<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Afficher toute les categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function viewAllCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Ajouter une categorie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCatgorie(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($category, 201);
    }

    /**
     * Recuperer une categorie specifique
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCategorie($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Mettre a jour une categorie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCategorie(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return response()->json($category);
    }

    /**
     * Supprimer une categories
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyCategorie($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }

}
