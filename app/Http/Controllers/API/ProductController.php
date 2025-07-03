<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller {

    /**
     * GET - API method for displaying a list of products.
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::with('categories')->get();
        return ProductResource::collection($products);
    }

    /**
     * POST - API method for storing a new product.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        $product->categories()->attach($request->validated('categories'));

        return (new ProductResource($product->load('categories')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * GET - API method for displaying a single product.
     */
    public function show(string $id): ProductResource
    {
        $product = Product::with('categories')->findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * PUT - API method for updating a product.
     */
    public function update(
        UpdateProductRequest $request,
        Product              $product
    ): ProductResource {
        $product->update($request->validated());

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return new ProductResource($product->load('categories'));
    }

    /**
     * DELETE - API method for deleting a product.
     */
    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
