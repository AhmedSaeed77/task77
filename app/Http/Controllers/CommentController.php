<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Services\CommentService;

class CommentController extends Controller
{

    public function __construct(private readonly CommentService $comment)
    {
        $this->middleware('auth');
    }


    public function store(CommentRequest $request)
    {
        return $this->comment->store($request);
    }


    public function destroy($id)
    {
        return $this->comment->destroy($id);
    }
}
