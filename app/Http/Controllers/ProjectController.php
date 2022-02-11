<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $user = auth()->user();
        $projects = $user->projects()->paginate(5);
        
        // $projects = Project::all();
        return view('projects.index', ['projects'=>$projects]);
    }

    public function show(Project $project) {
        return view('projects.board-task-view', ['project' => $project]);
    }

    public function settings(Project $project) {
        return view('projects.settings', ['project' => $project]);
    }

    public function create() {
        // $this->authorize('create', Post::class);
        return view('projects.create');
    }

    public function store(Request $request) {
        // $this->authorize('create', Post::class);

        $inputs = $request->validate([
            'title'=>'required|max:255',
        ]);
        $inputs['description'] = $request['description'];
        // dd($inputs);
        auth()->user()->projects()->create($inputs, ['role'=>'Owner']);

        $request->session()->flash('success', 'Project with title "'.$inputs['title'].'" was created');

        return redirect()->route('project.index');
    }

    public function edit(Project $project) {
        // $this->authorize('view', $project);
        // if(auth()->user()->can('view', $post)) {

        // }
        return view('projects.edit', ['project' => $project]);
    }

    public function update(Project $project, Request $request) {
        $inputs = $request->validate([
            'title'=>'required|max:255',
        ]);
        
        $project->title = $inputs['title'];
        $project->description = $request['description'];

        // $this->authorize('update', $project);

        $project->save();

        $request->session()->flash('update-message', 'Post with title "'.$project['title'].'" was updated');

        return redirect()->route('project.index');

        // $request->session()->flash('success', 'Post with title "'.$inputs['title'].'" was created');

        // return redirect()->route('post.index');
    }

    public function destroy(Project $project, Request $request) {
        // $this->authorize('delete', $project);

        $project->delete();
        $request->session()->flash('message', 'project was deleted');
        return back();
    }
}
