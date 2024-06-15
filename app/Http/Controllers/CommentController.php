<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|exists:photos,id',
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->photo_id = $request->photo_id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('photos.show', $request->photo_id)
                         ->with('success', 'Comment added successfully.');
    }
}
