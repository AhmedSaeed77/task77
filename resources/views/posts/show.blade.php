<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .post {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .post h1 {
            margin-top: 0;
            font-size: 28px;
            color: #333;
        }
        .post p {
            margin: 10px 0;
            color: #555;
        }
        .comments {
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .comment:last-child {
            border-bottom: none;
        }
        .comment h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .comment p {
            margin: 5px 0;
            color: #555;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
            height: 100px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545;
            border: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Display Post -->
    <div class="post">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
    </div>

    <!-- Display Comments -->
    <div class="comments">
        <h2>Comments</h2>

        @foreach($post->comments as $comment)
        <div class="comment">
            <div>
                <h3>{{ $comment->user->name }}</h3>
                <p>{{ $comment->content }}</p>
            </div>
            @if($comment->user_id == auth()->user()->id)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            @endif
        </div>
        @endforeach

        <!-- Form to Add a New Comment -->
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <label for="content">Comment</label>
                <textarea id="content" name="content" required></textarea>
            </div>

            <div class="form-group">
                <button type="submit">Submit Comment</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
