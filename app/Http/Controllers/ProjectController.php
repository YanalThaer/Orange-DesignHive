<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::whereNull('deleted_at')->get(); // Exclude soft-deleted projects
        return view('admin.projects.index', compact('projects'));
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
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        $project->delete(); // Perform a soft delete
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function deleted()
    {
        $projects = Project::onlyTrashed()->with('user')->get();
        return view('admin.projects.deleted', compact('projects'));
    }

    public function restore(Project $project)
    {
        $project->restore();
        return redirect()->route('projects.deleted')->with('success', 'Project restored successfully.');
    }

    public function showDeleted(Project $project)
    {
        return view('admin.projects.showdeleted', compact('project'));
    }
}
