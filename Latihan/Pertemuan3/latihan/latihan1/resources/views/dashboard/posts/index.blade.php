<x-dashboard-layout>
    <x-slot:title>My Posts</x-slot:title>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Message (Halaman 21) -->
            @if(session()->has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('dashboard.posts.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    + Buat Postingan Baru
                </a>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $post->title }}</td>
                            <td class="px-6 py-4">{{ $post->category->name }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('dashboard.posts.show', $post->slug) }}" class="font-medium text-blue-600 hover:underline">Lihat</a>
                                <a href="{{ route('dashboard.posts.edit', $post->slug) }}" class="font-medium text-yellow-600 hover:underline">Edit</a>
                                
                                <form action="{{ route('dashboard.posts.destroy', $post->slug) }}" method="post" class="inline">
                                    @method('delete')
                                    @csrf
                                    <button class="font-medium text-red-600 hover:underline" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>