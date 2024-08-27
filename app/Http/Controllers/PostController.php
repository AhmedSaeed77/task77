<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;

class PostController extends Controller
{

    public function __construct(private readonly PostService $post)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return $this->post->index();
    }

    public function show($id)
    {
        return $this->post->show($id);
    }

    public function create()
    {
        return $this->post->create();
    }

    public function store(PostRequest $request)
    {
        return $this->post->store($request);
    }

    public function edit(string $id)
    {
        return $this->post->edit($id);
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
