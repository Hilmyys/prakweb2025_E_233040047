<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    // READ (Halaman 13)
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)
                        ->latest()
                        ->paginate(10) // Pagination
        ]);
    }

    // FORM CREATE (Halaman 18)
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    // STORE (CREATE + UPLOAD + VALIDASI) (Halaman 20 & 22)
    public function store(Request $request)
    {
        // 1. Validasi
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug'  => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:2048', // Validasi Gambar
            'body' => 'required'
        ]);

        // 2. Upload Gambar jika ada
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // 3. Tambahkan data user_id dan excerpt
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        // 4. Simpan ke Database
        Post::create($validatedData);

        return redirect()->route('dashboard.posts.index')->with('success', 'Postingan baru berhasil ditambahkan!');
    }

    // SHOW
    public function show(Post $post)
    {
        return view('dashboard.posts.show', ['post' => $post]);
    }

    // FORM EDIT (TUGAS PRAKTEK: UPDATE)
    public function edit(Post $post)
    {
        if($post->author->id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    // UPDATE (TUGAS PRAKTEK: UPDATE)
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];

        // Cek slug, jika ganti baru divalidasi unique
        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        // Cek Gambar Baru
        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update($validatedData);

        return redirect()->route('dashboard.posts.index')->with('success', 'Postingan berhasil diperbarui!');
    }

    // DELETE (TUGAS PRAKTEK: DELETE)
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }
        
        Post::destroy($post->id);
        return redirect()->route('dashboard.posts.index')->with('success', 'Postingan berhasil dihapus!');
    }
}
