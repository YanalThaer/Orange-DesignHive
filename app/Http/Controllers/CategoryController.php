<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

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
        // dd(Auth::guard('admin')->user());
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $imagePath = 'images/categories/' . $imageName;
        }

        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'admin_id' => Auth::guard('admin')->user()->id,
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
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $imagePath = 'images/categories/' . $imageName;
        } else {
            $imagePath = $category->image;
        }

        $category->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
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

    public function deleted()
    {
        $categories = Category::onlyTrashed()->with('admin')->get();
        return view('admin.categories.deleted', compact('categories'));
    }

    public function restore(Category $category)
    {
        $category->restore();
        return redirect()->route('categories.deleted')->with('success', 'Category restored successfully.');
    }

    public function showDeleted(Category $category)
    {
        return view('admin.categories.showdeleted', compact('category'));
    }
}
