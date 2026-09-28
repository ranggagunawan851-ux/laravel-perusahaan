<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // Menampilkan halaman utama track consultation
    public function index()
    {
        return view('front.consultation-track');
    }

    // Memproses form pencarian berdasarkan kode unik
    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'Consultation code is required.',
        ]);

        $code = trim($request->code);

        // Cari data konsultasi beserta relasi service-nya
        $consultation = Consultation::with('service')
            ->where('code', $code)
            ->first();

        if (!$consultation) {
            return redirect()->route('front.consultation.track')
                ->with('error', 'Consultation code "' . $code . '" not found. Please check your code again!');
        }

        return view('front.consultation-track', compact('consultation'));
    }
}
