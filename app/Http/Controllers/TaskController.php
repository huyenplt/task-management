<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;
use App\Models\Project;

use Carbon\Carbon;
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

        if($request->description) {
            $inputs['description'] = $request['description'];
        }

        if($request->deadline) {
            $date = Carbon::createFromFormat('d-m-Y', $request->deadline);
            $inputs['deadline'] = $date->getTimestamp();
        }

        $board->tasks()->create($inputs);

        if($request->tag) {
            $task = Task::latest()->first();

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
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Task $task, Request $request) {
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
}
