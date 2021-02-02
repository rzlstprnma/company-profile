<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_posts = BlogPost::with(["category"])->get();
        return response()->json($blog_posts);
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
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,svg',
        ]);

        $post = new BlogPost();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        


        if($request->has('photo')){
            $imageName = time().'_post.'.$request->file('photo')->extension();  
            $request->file('photo')->storeAs('post_images', $imageName);
            $post->photo = $imageName;
            $post->save();
        }

        $blog_tag_id = explode(",", $request->blog_tag_id);
        $post->blog_tags()->sync($blog_tag_id);
        
        return response()->json($post);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_post = BlogPost::find($id);
        Storage::delete("post_images/".$blog_post->photo);
        $blog_post->delete();
        return response()->json($blog_post);
    }
}
