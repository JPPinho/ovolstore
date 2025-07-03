<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller {

    /**
     * GET - Web method for displaying a list of products.
     *
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * GET - Web method for displaying a form for creating a new product.
     *
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * POST - Web method for storing a new product.
     *
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        $product->categories()->attach($request->validated('categories'));

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * GET - Web method for displaying a single product.
     *
     */
    public function show(string $id)
    {
        return redirect()->route('admin.products.edit', $id);
    }

    /**
     * GET - Web method for displaying a form for editing a product.
     *
     */
    public function edit(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * PUT - Web method for updating a product.
     *
     */
    public function update(
        UpdateProductRequest $request,
        Product              $product
    ) {
        $product->update($request->validated());


        $product->categories()->sync($request->categories);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * DELETE - Web method for deleting a product.
     *
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
