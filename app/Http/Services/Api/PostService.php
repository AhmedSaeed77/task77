<?php

namespace App\Http\Services\Api;
use App\Models\Post;
use App\Http\Requests\Api\Post\PostRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function index()
    {
        $posts = Post::all();
        return response()->json(['posts' => $posts]);
    }


    public function store(PostRequest $request)
    {
        try
        {

            $id = auth()->user()->id;
            $data = $request->validated();
            $data = array_merge($data, ["user_id" => $id]);
            Post::create($data);
            return response()->json(['message' => 'created successfully'],200);
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['post' => $post]);
    }

    public function destroy($id)
    {
        try
        {
            $post = Post::find($id);
            $post->delete();
            return response()->json(['message' => 'deleted successfully'],200);
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(PostRequest $request, $id)
    {
        try
        {
            $post = Post::find($id);
            $data = $request->validated();
            $data = array_merge($data, ["user_id" => $id]);
            $post->update($data);
            return response()->json(['message' => 'updated successfully'],200);
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
