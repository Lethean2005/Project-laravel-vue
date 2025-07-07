<h1>Create Post</h1>

<form action="{{ route('posts.store') }}" method="POST">
  @csrf
  <input type="text" name="title" placeholder="Post Title"><br>
  <textarea name="body" placeholder="Post Body"></textarea><br>
  <button type="submit">Submit</button>
</form>
