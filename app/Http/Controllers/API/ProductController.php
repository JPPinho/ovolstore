<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $product = Product::create($request->only([
            'name', 'sku', 'description', 'price', 'stock'
        ]));

        $product->categories()->attach($request->categories);

        return (new ProductResource($product->load('categories')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'sku' => 'sometimes|required|string|max:255|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'categories' => 'sometimes|required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $product->update($request->only([
            'name', 'sku', 'description', 'price', 'stock'
        ]));

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return new ProductResource($product->load('categories'));
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
