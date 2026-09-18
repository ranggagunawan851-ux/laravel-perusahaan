<?php

namespace App\Http\Controllers\Back;

use App\Exports\ConsultationMonthlyExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Consultation;
use App\Models\Service;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ConsultationController extends Controller
{
    /**
     * PROSES UNTUK FRONT-END (User umum)
     */
    public function storePublic(Request $request)
    {
        // 1. Validasi Input Data
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'required|string|max:20',
            'service_id'        => 'required|exists:services,id',
            'message'           => 'required|string',
        ]);

        // 2. SIMPAN DATA KE DATABASE (Status default otomatis 'pending')
        $consultation = Consultation::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'service_id'        => $request->service_id,
            'message'           => $request->message,
            'status'            => 'pending',
        ]);

        // 3. Ambil Nama service
        $service = Service::find($request->service_id);
        $namaService = $service ? $service->nama_service : '-';

        // 4. Susun Format Pesan WhatsApp
        $nomorWaAdmin = '6282269174012';

        $text  = "Halo, saya telah mengirim formulir konsultasi:\n\n";
        $text .= "*Nama:* " . $request->name . "\n";
        $text .= "*Email:* " . $request->email . "\n";
        $text .= "*No HP/WA:* " . $request->phone . "\n";
        $text .= "*Service:* " . $namaService . "\n";
        $text .= "*Pesan/Kebutuhan:* " . $request->message;

        // 5. Generate Link WA & Redirect User
        $waUrl = "https://wa.me/" . $nomorWaAdmin . "?text=" . urlencode($text);

        return redirect()->away($waUrl);
    }

    /**
     * PROSES UNTUK BACK-END (Admin Panel)
     */

    public function exportExcel(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date'   => 'required|date|after_or_equal:start_date',
    ]);

    $startDate = $request->start_date;
    $endDate   = $request->end_date;

    $fileName = 'rekap_consultation_' . $startDate . '_s.d_' . $endDate . '.xlsx';

    return Excel::download(new ConsultationMonthlyExport($startDate, $endDate), $fileName);
}


    public function index()
    {
        return view('back.consultation.index', [
            'consultations' => Consultation::with('service')->latest()->get()
        ]);
    }

    public function create()
    {
        $services = Service::all();
        return view('back.consultation.create', compact('services'));
    }

    public function store(ConsultationRequest $request)
    {
        Consultation::create($request->validated());

        return redirect()->route('consultation.index')->with('success', 'Consultation created successfully!');
    }

    /**
     * Detail Consultation (Otomatis ubah status dari pending -> processed)
     */
    public function show(Consultation $consultation)
    {
        return view('back.consultation.show', [
            'consultation' => $consultation->load('service')
        ]);
    }

    public function edit(Consultation $consultation)
    {
        return view('back.consultation.update', [
            'consultation' => $consultation,
            'services'     => Service::all()
        ]);
    }

    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        $consultation->update($request->validated());

        return redirect()->route('consultation.index')->with('success', 'Consultation updated successfully!');
    }

    /**
     * Method baru untuk update status manual oleh Admin (misal: ke 'completed')
     */
    public function updateStatus(Request $request, Consultation $consultation)
{
    $request->validate([
        'status' => 'required|in:pending,processed,completed,cancelled',
    ]);

    $data = [
        'status' => $request->status,
    ];

    // Jika status diubah ke completed dan belum memiliki image, berikan URL Picsum Photos
    if ($request->status == 'completed' && !$consultation->image) {
        // rand() memastikan gambar acak yang tersimpan
        $data['image'] = 'https://picsum.photos/1200/800?random=' . rand(1, 999);
    }

    $consultation->update($data);

    return redirect()->back()->with('success', 'Status konsultasi berhasil diperbarui!');
}

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return response()->json([
            'message' => 'Data consultation has been deleted'
        ]);
    }
}
