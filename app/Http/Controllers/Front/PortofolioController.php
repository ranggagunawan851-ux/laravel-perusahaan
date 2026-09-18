<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;

class PortofolioController extends Controller
{
    public function index()
    {
        $keyword = request()->keyword;

        if ($keyword) {
            $portofolios = Portofolio::with('Category')
                        ->whereStatus(1)
                        ->where('title', 'like', '%' .$keyword. '%')
                        ->latest()
                        ->paginate(2);
        } else {
            $portofolios = Portofolio::with('Category')->whereStatus(1)->latest()->paginate(3);
        }

        return view('front.portofolio.index', [
            'portofolios' => $portofolios,
            'keyword' => $keyword,
        ]);
    }

    public function show($slug)
    {
        $portofolio = Portofolio::whereSlug($slug)->firstOrFail();

        // $portofolio->increment('views');

        return view('front.portofolio.show', [
            'portofolio' => $portofolio,
        ]);
    }
}
