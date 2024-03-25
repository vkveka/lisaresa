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
        ], 200);
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
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        // $comment->load('user', 'accomodation');

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
        ], 200);
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
        ], 200);
    }
}
