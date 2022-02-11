<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;
use App\Models\Tag;
use App\Models\User;
use App\Models\Project;


use Carbon\Carbon;
use Illuminate\Support\Str;

class TaskController extends Controller
{   
    public function showall() {
        $user = auth()->user();
        $tasks = $user->tasks()->paginate(5);
        
        // $projects = Project::all();
        return view('tasks.showall', ['tasks'=>$tasks]);
    }

    public function index(Task $task) {
        // $this->authorize('create', Post::class);
        return view('tasks.index', ['task' => $task]);
    }

    public function create(Board $board) {
        // $this->authorize('create', Post::class);
        $tags = Tag::all();
        return view('tasks.create', ['board' => $board, 'tags'=>$tags]);
    }

    public function store(Request $request, Board $board) {
        // $this->authorize('create', Post::class);

        $inputs = $request->validate([
            'title'=>'required|max:255',
        ]);

        if($request->description) {
            $inputs['description'] = $request['description'];
        }

        if($request->deadline) {
            $date = Carbon::createFromFormat('d-m-Y', $request->deadline);
            $inputs['deadline'] = $date->getTimestamp();
        }

        $board->tasks()->create($inputs);
        $task = Task::latest()->first();
        if($request->userInCharge) {
            $user = User::whereEmail($request->userInCharge)->first();
            // dd($user->email);
            $user->tasks()->attach($task);

            $project = Project::find($board->project_id);
            
            if(!$user->userInProject($project)) {
                $project->users()->attach($user, ['role'=>'Member']);
            }
        }

        if($request->tag) {
            // $task = Task::latest()->first();

            $tag['content'] = $request->tag;
            $tag['slug'] = Str::of(Str::lower(request('tag')))->slug('-');

            if($request->colorTag) {
                $tag['color'] = $request->colorTag;
            }

            $task->tags()->create($tag);
        }

        // dd($request);

        $request->session()->flash('success', 'Project with title "'.$inputs['title'].'" was created');

        return back();
    }

    public function edit(Task $task) {
        // $this->authorize('create', Post::class);
        $tags = Tag::all();
        return view('tasks.edit', ['task' => $task, 'tags' => $tags]);
    }

    public function update(Task $task, Request $request) {
        $inputs = $request->validate([
            'title'=>['required', 'string', 'max:255'],
        ]);
        

        if($request->description) {
            $inputs['description'] = $request['description'];
        }

        if($request->deadline) {
            $date = Carbon::createFromFormat('d-m-Y', $request->deadline);
            $inputs['deadline'] = $date->getTimestamp();
        }

        $task->update($inputs);

        if($request->tag) {
            $tag['content'] = $request->tag;
            $tag['slug'] = Str::of(Str::lower(request('tag')))->slug('-');

            if($request->colorTag) {
                $tag['color'] = $request->colorTag;
            }

            $task->tags()->create($tag);
        }
        $board = Board::find($task->board_id);
        // dd($board->project_id);

        // dd($project->boards);
        // var_dump($task->boards);

        $request->session()->flash('success', 'Project with title "'.$inputs['title'].'" was created');

        return redirect()->route('project.show', $board->project_id);
    }

    public function destroy(Task $task, Request $request) {
        // $this->authorize('delete', $project);

        $task->delete();
        // $board->tasks()->delete();
        $request->session()->flash('message', 'project was deleted');
        return back();
    }

    public function statusUpdate(Task $task) {

        // $task->status = 1;
        $task->update(['status'=>1, 'order'=>1]);

        return back();
    }
}
