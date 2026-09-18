<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('front.service.show', compact('service'));
    }
}
