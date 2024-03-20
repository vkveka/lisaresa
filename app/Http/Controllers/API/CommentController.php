<?php

namespace App\Http\Controllers\API;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('user', 'accomodation')->get();

        return response()->json([
            'status' => true,
            'message' => 'Tous les commentaires ont été récupérés',
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'title' => $request->title,
            'content' => $request->content,
            'note' => $request->note,
            'accomodation_id' => $request->accomodation_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Le commentaire a bien été posté',
            'comment' => $comment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        // $comment = Comment::with('user', 'accomodation')->find($comment->id);

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Le commentaire a été récupéré',
        //     'comments' => $comment,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update(
            $request->all()
        );

        return response()->json([
            'status' => true,
            'message' => 'Le commentaire a bien été modifié',
            'comment' => $comment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Le commentaire a bien été supprimé',
            'comment' => $comment,
        ]);
    }
}
