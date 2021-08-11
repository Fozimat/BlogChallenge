<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
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
        $posts = Post::with(['user', 'category', 'tags'])->paginate(5);
        return view('admin.post.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact(['categories', 'tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if ($request->hasFile('image')) {
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('posts', $filename, 'public');
        }

        $post = Post::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'post' => $request->post,
            'image' => $filename,
            'user_id' => auth()->user()->id,
        ]);
        $post->tags()->attach($request->tags);

        return redirect()->route('post.index')->with('status', 'Post successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact(['post', 'categories', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if ($request->hasFile('image')) {
            Storage::delete('public/posts/' . $post->image);
            $fileName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('posts', $fileName, 'public');
        } else {
            $fileName = $request->old_image;
        }
        $post->update([
            'title' => $request->title,
            'post' => $request->post,
            'image' => $fileName,
            'user_id' => $post->user->id,
            'category_id' => $request->category
        ]);
        $post->tags()->sync($request->tags);

        return redirect()->route('post.index')->with('status', 'Post successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
