<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Project;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $comments = Comment::with('user')->whereNull('deleted_at')->get();
        $projects = Project::all();
        
        // dd($comments);
        return view('admin.comments.index', compact('comments' , 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $projects = Project::all();
        return view('admin.comments.show', compact('comment' , 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $comment->delete(); // Perform a soft delete
        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }

    public function deleted()
    {
        $comments = Comment::onlyTrashed()->with(['user', 'projects'])->get();
        return view('admin.comments.deleted', compact('comments'));
    }

    public function restore(Comment $comment)
    {
        $comment->restore();
        return redirect()->route('comments.deleted')->with('success', 'Comment restored successfully.');
    }

    public function showDeleted(Comment $comment)
    {
        return view('admin.comments.showdeleted', compact('comment'));
    }
}
