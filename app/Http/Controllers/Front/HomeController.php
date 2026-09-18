<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Service;
use App\Models\Portofolio;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home.index', [
            'latest_post' => Article::latest()->first(),
            'articles'    => Article::with('Category')->whereStatus(1)->latest()->paginate(4),
            'services'  => Service::latest()->get(),
            'portofolios'    => Portofolio::with('Category')->whereStatus(1)->latest()->paginate(4)
        ]);
    }


    public function about()
    {
        return view('front.home.about');
    }
}
