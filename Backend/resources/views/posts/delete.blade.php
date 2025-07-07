<h1>Delete Post</h1>

<p>Are you sure you want to delete this post?</p>

<h3>{{ $post->title }}</h3>
<p>{{ $post->body }}</p>

<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" style="color:red;">Yes, Delete</button>
    <a href="{{ route('posts.index') }}">Cancel</a>
</form>
