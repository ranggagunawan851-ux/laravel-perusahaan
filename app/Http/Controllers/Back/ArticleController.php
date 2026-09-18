<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        return view('back.article.index', [
            'articles' => Article::with('category')->latest()->get()
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('back.article.create', compact('categories'));
    }

    public function store(ArticleRequest $request)
    {
        // 1. Ambil data yang sudah divalidasi oleh ArticleRequest
        $data = $request->validated();

        // [PENTING] Aktifkan baris di bawah ini HANYA jika Anda TIDAK ingin tag <p> masuk ke DB
        // $data['desc'] = strip_tags($request->desc);

        // 2. Upload Gambar jika ada
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('back', $fileName, 'public');
            $data['img'] = $fileName;
        }

        // 3. Tambahkan data pendukung
        $data['user_id'] = auth()->id();
        $data['slug']    = Str::slug($data['title']);

        // 4. Simpan ke database
        Article::create($data);

        return redirect()->route('article.index')->with('success', 'Article created successfully!');
    }

    public function show(string $id)
    {
        return view('back.article.show', [
            // Menggunakan findOrFail untuk keamanan jika ID tidak ditemukan
            'article' => Article::with(['user', 'category'])->findOrFail($id)
        ]);
    }

    public function edit(string $id)
    {
        return view('back.article.update', [
            'article'    => Article::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function update(UpdateArticleRequest $request, string $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->validated();

        // [PENTING] Aktifkan baris di bawah ini HANYA jika Anda TIDAK ingin tag <p> masuk ke DB
        $data['desc'] = strip_tags($request->desc);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('back', $fileName, 'public');

            // Hapus gambar lama jika ada
            if ($request->oldImg) {
                Storage::disk('public')->delete('back/' . $request->oldImg);
            }
            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }

        // Tambahkan data pendukung
        $data['user_id'] = auth()->id();
        $data['slug']    = Str::slug($data['title']);

        // Simpan perubahan ke database
        $article->update($data);

        return redirect()->route('article.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if ($article->img) {
            Storage::disk('public')->delete('back/' . $article->img);
        }

        $article->delete();

        return response()->json([
            'message' => 'Data article has been deleted'
        ]);
    }
}
