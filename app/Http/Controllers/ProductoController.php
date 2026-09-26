<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function index()
    {
        Log::info('Listando los productos');

        return Producto::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $producto = Producto::create(
            $request->only(['nombre', 'precio'])
        );

        Log::info('Producto creado', $producto->toArray());

        return response()->json($producto, 201);
    }

    public function show(string $id)
    {
        Log::info('Mostrando el producto con id: ' . $id);

        return Producto::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        Log::info('Actualizando el producto con id: ' . $id);

        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $producto->update(
            $request->only(['nombre', 'precio'])
        );

        Log::info('Producto actualizado', $producto->toArray());

        return response()->noContent();
    }

    public function destroy(string $id)
    {
        Log::info('Eliminando producto con id: ' . $id);

        Producto::destroy($id);

        return response()->json([
            'ok' => true
        ], 200);
    }
}