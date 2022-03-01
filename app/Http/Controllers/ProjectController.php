<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $this->authorize('show project');
        $projects = ProjectResource::collection(Project::paginate(10));

        return inertia('Projects/Index', [
            "projects" => fn() => $projects,
        ]);
    }
    public function create()
    {
        $this->authorize('create project');
        return inertia('Projects/Create');
    }
    public function store(Request $request)
    {
        $this->authorize('create project');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'domain_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        user()->projects()->create([
            'name' => $data['name'],
            'domain_name' => $data['domain_name'],
            'description' => $data['description'],
        ]);

        return redirect()->route('projects.index');
    }
    public function edit(Project $project, Request $request)
    {
        $this->authorize('update project');

        return inertia('Projects/Edit', [
            "project" => fn() => $project,
        ]);
    }
    public function update(Request $request, Project $project)
    {
        $this->authorize('update project');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'domain_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        $project->update([
            'name' => $data['name'],
            'domain_name' => $data['domain_name'],
            'description' => $data['description'],
        ]);
        return back(303);
    }
    public function destroy(Request $request, Project $project)
    {
        $this->authorize('destroy project');
        $this->middleware(['password.confirm']);
        $project->delete();
        return redirect()->route('projects.index');
    }
}
