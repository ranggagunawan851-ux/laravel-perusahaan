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
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th width="250px">Consultation Code</th>
                <td>: <span class="badge bg-primary font-monospace text-wrap">{{ $consultation->code }}</span></td>
            </tr>
            <tr>
                <th>Name</th>
                <td>: {{ $consultation->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: {{ $consultation->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>: {{ $consultation->phone }}</td>
            </tr>
            <tr>
                <th>Service</th>
                <td>:
                    @if ($consultation->service)
                    <div class="d-inline-flex align-items-center gap-3 p-2 border rounded bg-white shadow-sm my-1">
                        @if ($consultation->service->img)
                        <img src="{{ asset('storage/service/' . $consultation->service->img) }}"
                            alt="{{ $consultation->service->nama_service }}" class="rounded border"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border"
                            style="width: 60px; height: 60px; font-size: 10px;">
                            No Image
                        </div>
                        @endif
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
                <th>Message User</th>
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

            <!-- CATATAN ADMIN -->
            <tr>
                <th>Admin Note</th>
                <td>:
                    @if ($consultation->note)
                    <span class="fw-bold text-dark">{{ $consultation->note }}</span>
                    @else
                    <span class="text-muted italic">-</span>
                    @endif
                </td>
            </tr>

            <!-- BUKTI FOTO KEGIATAN -->
            <tr>
                <th>Activity Proof Photo</th>
                <td>:
                    @if ($consultation->image)
                    <div class="d-inline-block mt-1">
                        <a href="{{ asset('storage/' . $consultation->image) }}" target="_blank">
                            <img src="{{ asset('storage/' . $consultation->image) }}" alt="Bukti Kegiatan"
                                class="img-thumbnail shadow-sm rounded" style="max-height: 180px; object-fit: cover;">
                        </a>
                        <div class="small text-muted mt-1">*Click photo to view full size</div>
                    </div>
                    @else
                    <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Created At</th>
                <td>:
                    {{ \Carbon\Carbon::parse($consultation->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->translatedFormat('d M Y H:i') }}
                </td>
            </tr>
        </table>

        <!-- FORM UPDATE CONSULTATION -->
        <div class="card p-4 mb-4 bg-light border shadow-sm">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-pen-to-square me-2"></i>Update Consultation</h5>

            @if (in_array($consultation->status, ['completed', 'cancelled']))
            <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                <i class="fa-solid fa-lock me-2"></i>
                <div>
                    This consultation status is <strong>{{ strtoupper($consultation->status) }}</strong> and can no longer be changed.
                </div>
            </div>
            @endif

            <form action="{{ route('consultation.update-status', $consultation->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @php
                $isLocked = in_array($consultation->status, ['completed', 'cancelled']);
                @endphp

                <div class="row g-3">
                    <!-- 1. Select Status -->
                    <div class="col-md-12">
                        <label for="statusSelect" class="form-label fw-bold">Status</label>
                        <select name="status" id="statusSelect" class="form-select" {{ $isLocked ? 'disabled' : '' }}>
                            <option value="pending" {{ $consultation->status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="processed" {{ $consultation->status == 'processed' ? 'selected' : '' }}>
                                Processed</option>
                            <option value="completed" {{ $consultation->status == 'completed' ? 'selected' : '' }}>
                                Completed</option>
                            <option value="cancelled" {{ $consultation->status == 'cancelled' ? 'selected' : '' }}>
                                Cancelled</option>
                        </select>
                    </div>

                    <!-- 2. Detail Penyelesaian (Tampil jika status di DB 'completed' ATAU pilihan select saat ini 'completed') -->
                    <div class="col-md-12" id="completedFields"
                        style="display: {{ $consultation->status == 'completed' ? 'flex' : 'none' }}; flex-direction: column; gap: 1rem;">
                        <hr class="my-1">
                        <h6 class="fw-bold text-success mb-0"><i class="fa-solid fa-circle-check me-1"></i> Completion
                            Details</h6>

                        <!-- Upload Foto -->
                        <div>
                            <label for="image" class="form-label fw-bold">Upload Activity Photo Evidence</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                {{ $isLocked ? 'disabled' : '' }}>
                            <small class="text-muted">Format: JPG, PNG, WEBP (Max 2MB).</small>
                        </div>

                        <!-- Form Catatan Admin (Note) -->
                        <div>
                            <label for="note" class="form-label fw-bold">Admin Note</label>
                            <textarea name="note" id="note" class="form-control" rows="3"
                                placeholder="Write consultation result notes here..."
                                {{ $isLocked ? 'disabled' : '' }}>{{ old('note', $consultation->note) }}</textarea>
                        </div>
                    </div>
                </div>

                @if (!$isLocked)
                <div class="d-flex align-items-center gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes
                    </button>
                </div>
                @endif
            </form>
        </div>

        <!-- MODAL POP-UP FOTO -->
        @if ($consultation->image)
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
                    <div class="modal-body text-center bg-dark p-2">
                        <img src="{{ asset('storage/' . $consultation->image) }}" alt="Bukti Foto"
                            class="img-fluid rounded shadow" style="max-height: 500px; object-fit: contain;">
                    </div>
                    <div class="modal-footer">
                        <a href="{{ asset('storage/' . $consultation->image) }}" target="_blank"
                            class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Open Original Image
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="float-end mt-2">
            <a href="{{ route('consultation.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</main>

<!-- SCRIPT UNTUK MENAMPILKAN/SEMBUNYIKAN INPUT FOTO & NOTE -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.getElementById('statusSelect');
        const completedFields = document.getElementById('completedFields');

        statusSelect.addEventListener('change', function () {
            if (this.value === 'completed') {
                completedFields.style.display = 'flex';
            } else {
                completedFields.style.display = 'none';
            }
        });
    });

</script>
@endsection
