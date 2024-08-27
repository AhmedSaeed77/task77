<?php

namespace App\Http\Services;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\NewComment;

class CommentService
{

    public function store(CommentRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $id = auth()->user()->id;
            $data = $request->validated();
            $data = array_merge($data, ["user_id" => $id]);
            $comment = Comment::create($data);
            $data = [
                'name' => $comment->user->name,
                'comment' => $comment->content,
            ];
            Mail::to($comment->user->email)->send(new NewComment($data));
            DB::commit();
            return redirect()->route('posts.show', $request->post_id)->with('success', 'Post created successfully');
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try
        {
            $comment = Comment::find($id);
            $comment->delete();
            return redirect()->route('posts.show',$comment->post_id)->with('success', 'Post deleted successfully');
        }
        catch (Exception $e)
        {
            return redirect()->route('posts.index')->with('error', $e->getMessage());
        }
    }

}
