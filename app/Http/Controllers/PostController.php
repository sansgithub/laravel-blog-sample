<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $posts = Post::with('user')->where('user_id', '!=' , $id)
                ->get();
        $comments = Comment::all();
        return view('read-post')->withPosts($posts)->withComments($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_title' => 'min:20|max:50|required',
            'post_details' => 'min:5|required'
        ]);

        $post_title = $request->post_title;
        $post_details = $request->post_details;
        $user_id = Auth::user()->id; //get id of logged in user to reference for who created the post

        $post = new Post;
        $post->post_title = $post_title;
        $post->post_details = $post_details;
        $post->user_id = $user_id;
        $post->slug = str_slug($post->post_title);
        $post->save();

        return redirect()->route('home')
            ->with([
                'message' => 'Your question has been posted!'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        //$comments = Comment::all();
        return view('post', compact('post'));
        //return view('post')->withPost($post)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$this->validate($request,[
            'post_title' => 'min:20|max:50|required',
            'post_details' => 'min:5|required'
        ]);

        $post = DB::table('post')->find($request->id);
        $post_title = $request->post_title;
        $post_details = $request->post_details;
        $post->post_title = $post_title;
        $post->post_details = $post_details;

        $post->update();
        return response()->json(['new_title' => $post->post_title, 
            'new_detail'=> $post->post_details], 200);*/

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json($post);
    }
}
