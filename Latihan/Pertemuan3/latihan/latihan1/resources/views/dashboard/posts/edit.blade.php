<x-dashboard-layout>
    <x-slot:title>Edit Post</x-slot:title>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow mt-6">
        <form method="post" action="{{ route('dashboard.posts.update', $post->slug) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Judul</label>
                <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5" value="{{ old('title', $post->title) }}">
            </div>

            <div class="mb-5">
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900">Slug</label>
                <input type="text" id="slug" name="slug" class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5" value="{{ old('slug', $post->slug) }}">
            </div>

            <div class="mb-5">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Ganti Gambar</label>
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="mb-2 w-32 h-32 object-cover">
                @endif
                <input class="block w-full text-sm border rounded-lg cursor-pointer bg-gray-50" id="image" name="image" type="file">
            </div>

            <div class="mb-5">
                <label for="body" class="block mb-2 text-sm font-medium text-gray-900">Isi</label>
                <textarea id="body" name="body" rows="6" class="block p-2.5 w-full bg-gray-50 border rounded-lg">{{ old('body', $post->body) }}</textarea>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5">Update Postingan</button>
        </form>
    </div>
</x-dashboard-layout>