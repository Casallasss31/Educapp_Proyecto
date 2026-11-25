<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Concerns\AuthorizesWithPermissions;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductController extends Controller implements HasMiddleware
{
    use AuthorizesWithPermissions;

    public static function permissions(): array
    {
        return [
            'index' => 'products.view',
            'show' => 'products.view',
            'export' => 'products.view', 
            'store' => 'products.create',
            'update' => 'products.create',
            'destroy' => 'products.delete',
        ];
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Listado de productos (permiso products.view).',
            'data' => [
                ['id' => 1, 'name' => 'Laptop'],
                ['id' => 2, 'name' => 'Mouse'],
            ],
        ]);
    }

    public function store(): JsonResponse
    {
        return response()->json([
            'message' => 'Producto creado (permiso products.create).',
            'data' => [
                'id' => 3,
                'name' => 'Teclado',
            ],
        ], 201);
    }

    public function show(int $product): JsonResponse
    {
        return response()->json([
            'message' => 'Detalle de producto (permiso products.view).',
            'data' => [
                'id' => $product,
                'name' => 'Laptop',
            ],
        ]);
    }

    public function update(int $product): JsonResponse
    {
        return response()->json([
            'message' => 'Producto actualizado (permiso products.create).',
            'data' => [
                'id' => $product,
                'name' => 'Laptop Pro',
            ],
        ]);
    }

    public function destroy(int $product): JsonResponse
    {
        return response()->json([
            'message' => "Producto {$product} eliminado (permiso products.delete).",
        ]);
    }

    public function export(): JsonResponse
    {
        return response()->json([
            'message' => 'Exportación de productos (permiso products.view).',
            'data' => ['csv' => 'products.csv'],
        ]);
    }
}