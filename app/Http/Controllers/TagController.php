<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{
    public function destroy(Tag $tag, Request $request) {
        // $this->authorize('delete', $project);
        $tag->delete();
        $request->session()->flash('message', 'project was deleted');
        return back();
    }
}
