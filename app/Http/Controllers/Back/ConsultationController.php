<?php

namespace App\Http\Controllers\Back;

use App\Exports\ConsultationMonthlyExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Consultation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ConsultationController extends Controller
{
    /**
     * PROSES UNTUK FRONT-END (User umum)
     */
    public function storePublic(Request $request)
    {
        // 1. Cari Service terlebih dahulu (bisa lewat Slug atau ID)
        $service = Service::where('slug', $request->service_id)
                    ->orWhere('id', $request->service_id)
                    ->first();

        // 2. Validasi Input Data
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:20',
            'service_id' => 'required',
            'message'    => 'required|string',
        ]);

        // Pastikan Service ditemukan di database
        if (!$service) {
            return redirect()->back()->withErrors(['service_id' => 'Layanan yang dipilih tidak valid.'])->withInput();
        }

        // 3. SIMPAN DATA KE DATABASE (Kode unik terisi otomatis dari Model Event)
        $consultation = Consultation::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'service_id' => $service->id,
            'message'    => $request->message,
            'status'     => 'pending',
        ]);

        // 4. Load relasi service agar nama service bisa dipanggil di Blade modal WA
        $consultation->load('service');

        // 5. REDIRECT BACK DENGAN SESSION (Modal pop-up akan otomatis terbuka)
        return redirect()->back()->with('consultation_success', $consultation);
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

    public function updateStatus(Request $request, Consultation $consultation)
    {
        // Cegah perubahan data jika status sudah completed atau cancelled
        if (in_array($consultation->status, ['completed', 'cancelled'])) {
            return redirect()->back()->withErrors([
                'status' => 'This consultation status is locked and can no longer be changed.'
            ]);
        }

        $request->validate([
            'status' => 'required|in:pending,processed,completed,cancelled',
            'note'   => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'status' => $request->status,
            'note'   => $request->note,
        ];

        // Simpan foto HANYA jika admin mengunggah file baru
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($consultation->image && Storage::disk('public')->exists($consultation->image)) {
                Storage::disk('public')->delete($consultation->image);
            }

            // Simpan foto baru dari admin
            $data['image'] = $request->file('image')->store('consultations', 'public');
        }

        $consultation->update($data);

        return redirect()->back()->with('success', 'Status, note, and proof photo have been saved successfully!');
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return response()->json([
            'message' => 'Data consultation has been deleted'
        ]);
    }
}
