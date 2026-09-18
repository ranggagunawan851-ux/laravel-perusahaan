@extends('back.layout.template')

@section('title', 'Detail Consultation - Nexus Craft')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Consultation</h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="mt-3">
        <table class="table table-striped table-bordered">
            <tr>
                <th width="250px">Name</th>
                <td>: {{ $consultation->name }}</td>
            </tr>
            <tr>
                <th width="250px">Email</th>
                <td>: {{ $consultation->email }}</td>
            </tr>
            <tr>
                <th width="250px">Phone</th>
                <td>: {{ $consultation->phone }}</td>
            </tr>
            <tr>
                <th>Service</th>
                <td>:
                    @if ($consultation->service)
                    <div class="d-inline-flex align-items-center gap-3 p-2 border rounded bg-white shadow-sm mt-1">
                        <!-- Foto Service -->
                        @if ($consultation->service->img)
                        <img src="{{ asset('storage/service/' . $consultation->service->img) }}"
                            alt="{{ $consultation->service->nama_service }}" class="rounded border"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                        <!-- Placeholder teks jika file gambar di database kosong -->
                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border"
                            style="width: 60px; height: 60px; font-size: 10px;">
                            No Image
                        </div>
                        @endif

                        <!-- Nama & Harga Service -->
                        <div>
                            <div class="fw-bold text-dark">{{ $consultation->service->nama_service }}</div>
                            <div class="text-success small fw-semibold">
                                Rp {{ number_format($consultation->service->price ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    @else
                    <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Message</th>
                <td>: {!! $consultation->message !!}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>:
                    @if ($consultation->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                    @elseif ($consultation->status == 'processed')
                    <span class="badge bg-primary">Processed</span>
                    @elseif ($consultation->status == 'completed')
                    <span class="badge bg-success">Completed</span>
                    @elseif ($consultation->status == 'cancelled')
                    <span class="badge bg-danger">Cancelled</span>
                    @else
                    <span class="badge bg-secondary">{{ $consultation->status }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ \Carbon\Carbon::parse($consultation->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->translatedFormat('d-m-Y') }}
                </td>
            </tr>

        </table>

        <!-- Form Ubah Status Manual oleh Admin -->
        <div class="card p-3 mb-4 bg-light border">
            <form action="{{ route('consultation.update-status', $consultation->id) }}" method="POST"
                class="d-flex align-items-center gap-2">
                @csrf
                @method('PUT')

                <label for="status" class="fw-bold me-2">Update Consultation Status</label>
                <select name="status" id="status" class="form-select w-auto">
                    <option value="pending" {{ $consultation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ $consultation->status == 'processed' ? 'selected' : '' }}>Processed
                    </option>
                    <option value="completed" {{ $consultation->status == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                    <option value="cancelled" {{ $consultation->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                    </option>
                </select>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Save Status
                </button>

                <!-- TOMBOL PEMICU MODAL (Letakkan di sini agar sejajar) -->
                @if ($consultation->status == 'completed' || $consultation->image)
                <div class="border-start ps-3 ms-1">
                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                        data-bs-target="#modalBuktiFoto">
                        <i class="fa-solid fa-eye me-1"></i> View Activity Proof
                    </button>
                </div>
                @endif
            </form>
        </div>

        <!-- Modal Pop-up Bukti Kegiatan -->
        <div class="modal fade" id="modalBuktiFoto" tabindex="-1" aria-labelledby="modalBuktiFotoLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalBuktiFotoLabel">
                            <i class="fa-regular fa-image me-2"></i>Consultation Activity Proof
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center bg-dark">
                        <!-- Foto Acak dari Picsum -->
                        <img src="https://picsum.photos/1200/800?random={{ rand(1, 999) }}" alt="Bukti Kegiatan"
                            class="img-fluid rounded shadow" style="max-height: 500px; object-fit: contain;">
                    </div>
                    <div class="modal-footer">
                        <a href="https://picsum.photos/1200/800?random={{ rand(1, 999) }}" target="_blank"
                            class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Open in New Tab
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div class="float-end mt-2">
        <a href="{{ route('consultation.index') }}" class="btn btn-secondary">Back</a>
    </div>
    </div>
</main>
@endsection
