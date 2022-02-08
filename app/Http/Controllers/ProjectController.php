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

    public function create() {
        // $this->authorize('create', Post::class);
        return view('projects.create');
    }

    public function store(Request $request) {
        // $this->authorize('create', Post::class);

        // $inputs = $request->validate([
        //     'title'=>'required|min:8|max:255',
        //     'post_image'=>'file',
        //     'body'=>'required'
        // ]);

        // if($request->post_image) {
        //     $inputs['post_image'] = $request->post_image->store('images');
        //     // $user = Auth::user();
        //     // $user()->posts()->create($inputs);
        // }

        // auth()->user()->posts()->create($inputs);

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
