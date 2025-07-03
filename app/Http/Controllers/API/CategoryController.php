<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends Controller {

    /**
     * GET - API method for displaying a nested list of categories.
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * POST - API method for storing a new category.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * GET - API method for displaying a single category.
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * PUT - API method for updating a category.
     */
    public function update(
        UpdateCategoryRequest $request,
        Category              $category
    ): CategoryResource {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * DELETE - API method for deleting a category.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
