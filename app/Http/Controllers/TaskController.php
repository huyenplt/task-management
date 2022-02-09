<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;

use Illuminate\Support\Str;

class TaskController extends Controller
{   
    public function index(Task $task) {
        // $this->authorize('create', Post::class);
        return view('tasks.index', ['task' => $task]);
    }

    public function create(Board $board) {
        // $this->authorize('create', Post::class);
        return view('tasks.create', ['board' => $board]);
    }

    public function store(Request $request, Board $board) {
        // $this->authorize('create', Post::class);

        $inputs = $request->validate([
            'title'=>'required|max:255',
        ]);
        $inputs['description'] = $request['description'];

        $board->tasks()->create($inputs);

        if($request->tag) {
            $task = Task::latest()->first();

            $tag['content'] = $request->tag;
            $tag['slug'] = Str::of(Str::lower(request('tag')))->slug('-');

            $task->tags()->create($tag);
        }



        // $permission->slug = Str::of(Str::lower(request('name')))->slug('-');
        // dd($inputs);
        // dd($project->id);

        // $project->boards()->create($inputs);

        $request->session()->flash('success', 'Project with title "'.$inputs['title'].'" was created');

        return back();
    }
}
