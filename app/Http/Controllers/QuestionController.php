<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function postQuestion(Request $request)
    {
         $this->validate($request, [
             'postTitle' => 'required',
             'postDetail' => 'required'
         ]);

        $post = Post::find($request['postId']);
        $post->post_title = $request['postTitle'];;
        $post->post_details = $request['postDetail'];

        $post->update();
        return response()->json(['new_title' => $post->post_title, 
            'new_details'=> $post->post_details], 200);
    }

    public function postCommentStore($id, Request $request)
    {
        $this->validate($request, [
            'comment_details' => 'required'
        ]);
        try {
        $comment_details = $request->comment_details;
        $user_id = Auth::user()->id;
        $comment = new Comment;
        $comment->comment_details = $comment_details;
        $comment->user_id = $user_id;
        $comment->post_id = $id;
        $comment->save();
        return response()->json($comment);  
        }
        catch(\Exception $e)
        {
            return $e;
        }
        
        
    }
}
