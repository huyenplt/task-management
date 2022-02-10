<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Board;

use Illuminate\Support\Str;

class BoardController extends Controller
{
    public function store(Request $request, Project $project) {
        // $this->authorize('create', Post::class);

        $inputs = $request->validate([
            'title'=>'required|max:255',
        ]);

        $inputs['slug'] = Str::of(Str::lower(request('title')))->slug('-');
        // $permission->slug = Str::of(Str::lower(request('name')))->slug('-');
        // dd($inputs);
        // dd($project->id);

        $project->boards()->create($inputs);

        $request->session()->flash('success', 'Project with title "'.$inputs['title'].'" was created');

        return back();
    }

    public function edit(Board $board) {
        // $this->authorize('view', $project);
        // if(auth()->user()->can('view', $post)) {

        // }
        return view('boards.edit', ['board' => $board]);
    }

    public function update(Board $board, Request $request) {
        $inputs = $request->validate([
            'title'=>'required|max:255',
        ]);
        
        $board->title = $inputs['title'];

        // $this->authorize('update', $project);

        $board->save();

        $request->session()->flash('update-message', 'Post with title "'.$board['title'].'" was updated');

        return back();

        // $request->session()->flash('success', 'Post with title "'.$inputs['title'].'" was created');

        // return redirect()->route('post.index');
    }

    public function destroy(Board $board, Request $request) {
        // $this->authorize('delete', $project);

        $board->delete();
        $board->tasks()->delete();
        $request->session()->flash('message', 'project was deleted');
        return back();
    }
}
