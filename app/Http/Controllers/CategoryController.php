<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::whereNull('deleted_at')->get(); // Exclude soft-deleted records
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url', // Validate image as a URL
        ]);
    
        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $request->input('image'), // Save the image URL directly
            'admin_id' => $request->input('admin_id'),
        ]);
    
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url', // Validate image as a URL
        ]);
    
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $request->input('image'), // Update the image URL directly
        ]);
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete(); // Perform a soft delete
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

 
}
