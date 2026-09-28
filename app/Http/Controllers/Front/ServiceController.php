<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $keyword = request()->keyword;

        if ($keyword) {
            $services = Service::with('Category')
                        ->where('title', 'like', '%' .$keyword. '%')
                        ->latest()
                        ->paginate(2);
        } else {
            $services = Service::with('Category')->latest()->paginate(3);
        }

        return view('front.service.index', [
            'services' => $services,
            'keyword' => $keyword,
        ]);
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('front.service.show', compact('service'));
    }
}