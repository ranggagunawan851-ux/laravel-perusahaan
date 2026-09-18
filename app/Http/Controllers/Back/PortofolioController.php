<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortofolioRequest;
use App\Http\Requests\UpdatePortofolioRequest;
use App\Models\Category;
use App\Models\Portofolio;
use App\Models\PortofolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.portofolio.index', [
            'portofolios' => Portofolio::with(['category', 'images'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.portofolio.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortofolioRequest $request)
    {
        $data = $request->validated();

        // Generasi slug unik
        $slug = Str::slug($data['title']);
        $count = Portofolio::where('slug', 'LIKE', "{$slug}%")->count();
        $data['slug'] = $count ? "{$slug}-" . time() : $slug;

        // Ambil array gambar dari input img[]
        $files = $request->file('img');

        if ($files && is_array($files)) {
            // 1. Ambil foto PERTAMA untuk dijadikan Cover Utama ($portofolio->img)
            $firstFile = array_shift($files); // Mengambil file pertama & mengeluarkannya dari array $files
            $firstFileName = uniqid() . '.' . $firstFile->getClientOriginalExtension();
            $firstFile->storeAs('portofolio', $firstFileName, 'public');
            $data['img'] = $firstFileName;

            // 2. Simpan Data Utama Portofolio
            $portofolio = Portofolio::create($data);

            // 3. Simpan SISA foto (foto ke-2, ke-3, dst) ke tabel portofolio_images
            foreach ($files as $file) {
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('portofolio', $fileName, 'public');

                $portofolio->images()->create([
                    'image_path' => $fileName
                ]);
            }
        } else {
            Portofolio::create($data);
        }

        return redirect()->route('portofolio.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('back.portofolio.show', [
            'portofolio' => Portofolio::with(['category', 'images'])->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.portofolio.update', [
            'portofolio' => Portofolio::with('images')->findOrFail($id),
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortofolioRequest $request, string $id)
    {
        // Load relasi images agar data foto galeri terbaca
        $portofolio = Portofolio::with('images')->findOrFail($id);
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['slug']    = Str::slug($data['title']);

        // Jika pengguna mengunggah gambar baru
        if ($request->hasFile('img')) {
            $files = $request->file('img');

            // 1. HAPUS COVER UTAMA LAMA DARI STORAGE
            if ($portofolio->img && Storage::disk('public')->exists('portofolio/' . $portofolio->img)) {
                Storage::disk('public')->delete('portofolio/' . $portofolio->img);
            }

            // 2. HAPUS SEMUA FOTO GALERI LAMA DARI STORAGE & DATABASE
            foreach ($portofolio->images as $oldImage) {
                if (Storage::disk('public')->exists('portofolio/' . $oldImage->image_path)) {
                    Storage::disk('public')->delete('portofolio/' . $oldImage->image_path);
                }
            }
            $portofolio->images()->delete(); // Hapus data di DB

            // 3. AMBIL GAMBAR PERTAMA SEBAGAI COVER UTAMA (pisahkan dari array galeri)
            $firstFile = array_shift($files);
            $firstFileName = uniqid() . '.' . $firstFile->getClientOriginalExtension();
            $firstFile->storeAs('portofolio', $firstFileName, 'public');
            $data['img'] = $firstFileName;

            // 4. SIMPAN SISA GAMBAR BARU KE TABEL RELASI (biar slide gambarnya beda-beda)
            foreach ($files as $file) {
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('portofolio', $fileName, 'public');

                $portofolio->images()->create([
                    'image_path' => $fileName
                ]);
            }
        } else {
            // Jika tidak upload baru, tetap gunakan gambar lama
            $data['img'] = $request->oldImg ?? $portofolio->img;
        }

        $portofolio->update($data);

        return redirect()->route('portofolio.index')->with('success', 'Portofolio updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portofolio = Portofolio::with('images')->findOrFail($id);

        // 1. Hapus semua file fisik foto galeri di storage
        foreach ($portofolio->images as $image) {
            if ($image->image_path && Storage::disk('public')->exists('portofolio/' . $image->image_path)) {
                Storage::disk('public')->delete('portofolio/' . $image->image_path);
            }
        }

        // 2. Hapus file fisik foto cover di storage
        if ($portofolio->img && Storage::disk('public')->exists('portofolio/' . $portofolio->img)) {
            Storage::disk('public')->delete('portofolio/' . $portofolio->img);
        }

        // 3. Hapus record dari database
        $portofolio->delete();

        return response()->json([
            'message' => 'Data portofolio has been deleted'
        ]);
    }
}
