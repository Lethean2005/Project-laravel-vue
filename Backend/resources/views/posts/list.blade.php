<div class="max-w-4xl mx-auto p-6">
  <h1 class="text-3xl font-bold text-gray-800 mb-6">All Posts</h1>

  <a href="{{ route('posts.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
    ➕ Create New Post
  </a>

  @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
      {{ session('success') }}
    </div>
  @endif

  <table class="w-full border-collapse shadow-md">
    <thead>
      <tr class="bg-gray-100 text-left">
        <th class="p-3 border-b border-gray-300">Title</th>
        <th class="p-3 border-b border-gray-300">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <tr class="hover:bg-gray-50">
          <td class="p-3 border-b border-gray-200">{{ $post->title }}</td>
          <td class="p-3 border-b border-gray-200 space-x-2">
            <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
              @csrf
              @method('DELETE')
              <button class="text-red-600 hover:underline">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
