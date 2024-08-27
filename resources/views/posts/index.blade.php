<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
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
        .add-post {
            display: block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .post {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            cursor: pointer;
            position: relative;
        }
        .post:last-child {
            border-bottom: none;
        }
        .post h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .post p {
            margin: 5px 0;
            color: #555;
        }
        .post .date {
            font-size: 12px;
            color: #999;
        }
        .post-buttons {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .post-buttons button {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
        }
        .post-buttons button:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Posts</h1>

    <!-- Button to add a new post -->
    <a href="{{ route('posts.create') }}" class="add-post">Add New Post</a>

    <!-- Loop through posts -->
    @foreach($posts as $post)
    <div class="post" onclick="window.location='{{ route('posts.show', $post->id) }}'">
        <h2>{{ $post->title }}</h2>
        <p>{{ Str::limit($post->content, 100) }}</p> <!-- Show an excerpt of the content -->

        <!-- Conditional buttons for edit and delete -->

        <div class="post-buttons">
            @if($post->user_id == auth()->user()->id)
            <a href="{{ route('posts.edit', $post->id) }}">
                <button>Edit</button>
            </a>
            @endif
            @if($post->user_id == auth()->user()->id)
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
</div>

</body>
</html>
