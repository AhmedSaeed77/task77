<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\Post\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Api\PostService;

class PostController extends Controller
{
    public function __construct(private readonly PostService $post)
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return $this->post->index();
    }

    public function show($id)
    {
        return $this->post->show($id);
    }

    public function store(PostRequest $request)
    {
        return $this->post->store($request);
    }

    public function update(PostRequest $request, string $id)
    {
        return $this->post->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->post->destroy($id);
    }
}
