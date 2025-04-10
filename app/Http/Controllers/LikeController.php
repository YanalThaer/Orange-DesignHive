<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }

    public function toggleLike(Request $request)
    {
        $myuser = Auth::user();
        if (!$myuser) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = $myuser->id;
        $projectId = $request->project_id;

        $like = Like::where('user_id', $user)->where('project_id', $projectId)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user,
                'project_id' => $projectId
            ]);
            $liked = true;
        }

        $likesCount = Like::where('project_id', $projectId)->count();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }

}
