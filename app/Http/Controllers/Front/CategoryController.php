<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($slug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Ambil artikel yang termasuk dalam kategori tersebut
        $articles = Article::where('category_id', $category->id)
                           ->latest()
                           ->paginate(6);

        return view('front.category.index', compact('category', 'articles'));
    }
}
