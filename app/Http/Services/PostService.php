<?php

namespace App\Http\Services;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        try
        {
            $id = auth()->user()->id;
            $data = $request->validated();
            $data = array_merge($data, ["user_id" => $id]);
            Post::create($data);
            return redirect()->route('posts.index')->with('success', 'Post created successfully');
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show',compact('post'));
    }

    public function destroy($id)
    {
        try
        {
            $post = Post::find($id);
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        }
        catch (Exception $e)
        {
            return redirect()->route('posts.index')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        try
        {
            $post = Post::find($id);
            $data = $request->validated();
            $post->update($data);
            return redirect()->route('posts.index')->with('success', 'Post updated successfully');
        }
        catch (Exception $e)
        {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }


}
