<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Portofolio;
use App\Models\Service;
use App\Models\Consultation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('back.dashboard.index', [
            'total_articles' => Article::count(),
            'total_services' => Service::count(),
            'total_portofolios' => Portofolio::count(),
            'total_consultations' => Consultation::count(),
            'latest_article' => Article::with('Category')->whereStatus(1)->latest()->take(5)->get(),
            'latest_consultation' => Consultation::with('Service')->latest()->take(5)->get()
        ]);
    }
}
