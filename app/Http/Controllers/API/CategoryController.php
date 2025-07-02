<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     * GET /api/categories
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created category in storage.
     * POST /api/categories
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified category.
     * GET /api/categories/{category}
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified category in storage.
     * PUT/PATCH /api/categories/{category}
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified category from storage.
     * DELETE /api/categories/{category}
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
