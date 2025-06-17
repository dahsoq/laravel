<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $comment = Comment::create([
            'username' => $request->username,
            'text' => $request->text,
        ]);

        return response()->json($comment);
    }
    public function index()
    {
        $comments = Comment::latest()->get();
        return response()->json($comments);
    }
}