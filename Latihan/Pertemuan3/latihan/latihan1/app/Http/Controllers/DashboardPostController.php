<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)
                        ->with('category') 
                        ->paginate(10)
        ]);
    }

    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug'  => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:2048', 
            'body' => 'required'
        ]);

        if ($request->file('image')) {
            // PERBAIKAN: Tambahkan 'public' agar masuk ke storage/app/public
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validatedData);

        return redirect()->route('dashboard.posts.index')->with('success', 'Postingan baru berhasil ditambahkan!');
    }

    public function show(Post $post)
    {
        return view('dashboard.posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        // Pastikan model Post punya relasi method author() atau user()
        // Jika di model nama fungsinya user(), ganti author->id jadi user->id
        if($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];

        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($post->image) {
                // Hapus gambar lama
                Storage::delete($post->image);
            }
            // PERBAIKAN: Tambahkan 'public'
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update($validatedData);

        return redirect()->route('dashboard.posts.index')->with('success', 'Postingan berhasil diperbarui!');
    }
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }
        
        Post::destroy($post->id);
        return redirect()->route('dashboard.posts.index')->with('success', 'Postingan berhasil dihapus!');
    }
    public function checkSlug(Request $request)
    {
        $slug = \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}