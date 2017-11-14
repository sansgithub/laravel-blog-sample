<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests;
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
}
