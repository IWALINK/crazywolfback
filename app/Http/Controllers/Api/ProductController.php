<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Liste des produits',
            'data' => [
                [
                    'id' => 1,
                    'name' => 'iPhone 15',
                    'price' => 999.99,
                    'category' => 'Smartphones',
                    'in_stock' => true
                ],
                [
                    'id' => 2,
                    'name' => 'MacBook Pro',
                    'price' => 1999.99,
                    'category' => 'Laptops',
                    'in_stock' => true
                ],
                [
                    'id' => 3,
                    'name' => 'AirPods Pro',
                    'price' => 249.99,
                    'category' => 'Audio',
                    'in_stock' => false
                ]
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'in_stock' => 'boolean'
        ]);

        return response()->json([
            'message' => 'Produit créé avec succès',
            'data' => array_merge($validated, ['id' => rand(100, 999)])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json([
            'message' => 'Détails du produit',
            'data' => [
                'id' => $id,
                'name' => 'iPhone 15',
                'price' => 999.99,
                'category' => 'Smartphones',
                'in_stock' => true,
                'description' => 'Le dernier iPhone avec des fonctionnalités avancées',
                'created_at' => now()->toISOString()
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'category' => 'sometimes|string|max:255',
            'in_stock' => 'sometimes|boolean'
        ]);

        return response()->json([
            'message' => 'Produit mis à jour avec succès',
            'data' => array_merge(['id' => $id], $validated)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return response()->json([
            'message' => 'Produit supprimé avec succès',
            'data' => ['id' => $id]
        ]);
    }

    /**
     * Search products by category
     */
    public function search(Request $request): JsonResponse
    {
        $category = $request->query('category');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        return response()->json([
            'message' => 'Résultats de recherche',
            'filters' => [
                'category' => $category,
                'min_price' => $minPrice,
                'max_price' => $maxPrice
            ],
            'data' => [
                [
                    'id' => 1,
                    'name' => 'iPhone 15',
                    'price' => 999.99,
                    'category' => 'Smartphones',
                    'in_stock' => true
                ]
            ]
        ]);
    }
} 