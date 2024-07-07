<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->review_id = $request->review_id;
        $comment->save();
        return redirect()->back();
    }

}
