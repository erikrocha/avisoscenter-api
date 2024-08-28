<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
  public function index()
  {

  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'user_id' => 'required|exists:users,id',
      'ad_id' => 'exists:ads,id',
      'business_id' => 'exists:businesses,id',
      'comment' => 'required|string|max:255',
      'status' => 'required|string'
    ]);

    $comment = Comment::create($validatedData);

    return response()->json($comment,201);
  }
}
