<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Requests\api\v1\CategoryStoreRequest;
use App\Http\Requests\api\v1\CategoryUpdateRequest;
use App\Http\Resources\api\v1\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class );
        $categories = Category::all();
        return new CategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $this->authorize('create', Category::class);

        $validatedData = $request->validated();
        $category = Category::create($validatedData);

        return ResponseMessages::success(['message' => 'Category created successfully', new CategoryResource($category)],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('view', $category);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $validatedData = $request->validated();
        $category->update($validatedData);

        return ResponseMessages::success(['message' => 'Category updated successfully', new CategoryResource($category)],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete($category);

        return ResponseMessages::success('Category deleted successfully',204);
    }
}
