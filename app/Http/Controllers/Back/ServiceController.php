<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.service.index', [
            'service' => Service::with('category')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.service.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->validate([
        'category_id'   => 'required|integer|exists:categories,id',
        'nama_service'  => 'required|min:3',
        'img'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'desc'          => 'required',
        'price'         => 'required|numeric|min:0',
        'publish_date'  => 'nullable|date',
    ]);

        // 2. Upload Gambar jika ada
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('service', $fileName, 'public');
        $data['img'] = $fileName;
        }

        // 3. Tambahkan data pendukung
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['nama_service']);
        // 4. Simpan ke database
        Service::create($data);

        return redirect()->route('service.index')->with('success', 'Service created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('back.service.show', [
            'service' => Service::with(['Category'])->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.service.update', [
            'service'       => Service::find($id),
            'categories'    => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('service', $fileName, 'public');

            // Delete OldImg
           if ($request->oldImg) {
                Storage::disk('public')->delete('service/' . $request->oldImg);}
            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }

        // 3. Tambahkan data pendukung
        $data['user_id'] = auth()->id();
        $data['slug']    = Str::slug($data['nama_service']);

        // 4. Simpan ke database
        Service::find($id)->update($data);

        return redirect()->route('service.index')->with('success', 'Service updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Service::findOrFail($id);

        if ($data->img) {
        Storage::disk('public')->delete([
            'service/' . $data->img,
        ]);
    }

    $data->delete();

    return response()->json([
        'message' => 'Data Service has been deleted'
    ]);
    }
}
