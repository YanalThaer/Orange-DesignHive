<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tags = Tag::with('admin')->whereNull('deleted_at')->get();
        // dd($tags);
        // dd($tags->pluck('admin_id'));
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        // dd(Auth::guard('admin')->user()->id);
        $request->validate([
            'name' => 'required|unique:tags',
        ]);

        Tag::create([
            'name' => $request->name,
            'admin_id' => Auth::guard('admin')->user()->id
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id,
        ]);

        $tag->update([
            'name' => $request->name,
            'admin_id' => Auth::guard('admin')->user()->id
        ]);
        // dd($tag);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }

    public function deleted()
    {
        $tags = Tag::onlyTrashed()->with('admin')->get();
        return view('admin.tags.deleted', compact('tags'));
    }

    public function restore(Tag $tag)
    {
        $tag->restore();
        return redirect()->route('tags.deleted')->with('success', 'Tag restored successfully.');
    }

    public function showDeleted(Tag $tag)
    {
        return view('admin.tags.showdeleted', compact('tag'));
    }
}
