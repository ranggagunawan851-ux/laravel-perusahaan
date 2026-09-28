@extends('front.layout.template')

@section('title', 'Track Consultation - Nexus Craft')

@section('content')
<style>
    /* Styling Sentuhan Mewah & Elegan */
    .bg-dark-gold {
        background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        border-bottom: 2px solid #d97706;
    }
    .text-gold {
        color: #f59e0b;
    }
    .badge-status-completed {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
        box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
    }
    .badge-status-pending {
        background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
        color: #fff;
        box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
    }
    .badge-status-processed {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
        box-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);
    }
    .badge-status-cancelled {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        color: #fff;
        box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
    }
    .info-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6b7280;
        font-weight: 600;
    }
    .info-value {
        font-size: 0.98rem;
        color: #1f2937;
        font-weight: 500;
    }
    .image-preview-container {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .image-preview-container:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15);
    }
    .image-preview-container img {
        transition: transform 0.4s ease;
    }
    .image-preview-container:hover img {
        transform: scale(1.03);
    }
    .card-luxury {
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.08);
        background: #ffffff;
    }
</style>

<div class="container py-5 my-3">
    <div class="row justify-content-center">
        <!-- HEADER & FORM TRACKING -->
        <div class="col-lg-8 text-center">
            <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase" style="letter-spacing: 1.5px; font-size: 0.75rem;">
                <i class="fa-solid fa-gem me-1"></i> Exclusive Service
            </span>
            <h2 class="fw-bold text-dark display-6 mb-2">Track Your Consultation</h2>
            <p class="text-muted mb-4">Enter your unique consultation code to track project progress, architect notes, and project documentation.</p>

            <div class="card p-3 p-md-4 shadow-sm border-0 rounded-4 bg-white mb-5">
                <form action="{{ route('front.consultation.check') }}" method="POST">
                    @csrf
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-0 text-muted px-3">
                            <i class="fa-solid fa-hashtag text-warning"></i>
                        </span>
                        <input type="text" name="code" class="form-control border-0 bg-light font-monospace fw-bold"
                            placeholder="Example: CNS-MSVZY3LV"
                            value="{{ old('code', isset($consultation) ? $consultation->code : '') }}" required
                            style="letter-spacing: 1px;">
                        <button class="btn btn-dark px-4 fw-bold" type="submit" style="background: #111827;">
                            <i class="fa-solid fa-magnifying-glass me-2 text-warning"></i> Check Status
                        </button>
                    </div>
                </form>

                @if (session('error'))
                    <div class="alert alert-danger mt-3 mb-0 rounded-3 text-start d-flex align-items-center gap-2" role="alert">
                        <i class="fa-solid fa-circle-exclamation fs-5"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- HASIL TRACKING KONSULTASI -->
        @if (isset($consultation))
        <div class="col-lg-10">
            <div class="card card-luxury overflow-hidden">
                <!-- HEADER KARTU MEWAH -->
                <div class="card-header bg-dark-gold text-white p-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-ticket fs-4"></i>
                        </div>
                        <div>
                            <span class="text-uppercase small text-gray-400 d-block" style="font-size: 0.75rem; letter-spacing: 1px;">Consultation Code</span>
                            <h4 class="mb-0 font-monospace fw-bold text-gold" style="letter-spacing: 1.5px;">{{ $consultation->code }}</h4>
                        </div>
                    </div>

                    <div>
                        @if ($consultation->status == 'completed')
                            <span class="badge badge-status-completed px-4 py-2 rounded-pill fs-6 fw-semibold">
                                <i class="fa-solid fa-circle-check me-1"></i> Completed
                            </span>
                        @elseif ($consultation->status == 'processed')
                            <span class="badge badge-status-processed px-4 py-2 rounded-pill fs-6 fw-semibold">
                                <i class="fa-solid fa-spinner fa-spin me-1"></i> Processed
                            </span>
                        @elseif ($consultation->status == 'pending')
                            <span class="badge badge-status-pending px-4 py-2 rounded-pill fs-6 fw-semibold">
                                <i class="fa-solid fa-clock me-1"></i> Pending
                            </span>
                        @else
                            <span class="badge badge-status-cancelled px-4 py-2 rounded-pill fs-6 fw-semibold">
                                <i class="fa-solid fa-circle-xmark me-1"></i> Cancelled
                            </span>
                        @endif
                    </div>
                </div>

                <!-- BODY KARTU -->
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 g-lg-5">

                        <!-- KOLOM KIRI: INFORMASI KLIEN -->
                        <div class="col-md-6 border-end-md">
                            <h6 class="fw-bold text-dark mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
                                <i class="fa-solid fa-user-gear text-warning"></i> Consultation Details
                            </h6>

                            <div class="mb-3">
                                <div class="info-label">Customer Name</div>
                                <div class="info-value text-capitalize">{{ $consultation->name }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="info-label">Email</div>
                                    <div class="info-value text-break">{{ $consultation->email }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="info-label">Number WhatsApp</div>
                                    <div class="info-value">{{ $consultation->phone }}</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="info-label">Selected Service</div>
                                <div class="info-value fw-bold text-dark">
                                    {{ $consultation->service->nama_service ?? '-' }}
                                </div>
                            </div>

                            <div>
                                <div class="info-label">Client Message / Request</div>
                                <div class="p-3 bg-light rounded-3 mt-1 border text-secondary" style="font-size: 0.93rem;">
                                    "{!! $consultation->message !!}"
                                </div>
                            </div>
                        </div>

                        <!-- KOLOM KANAN: CATATAN & BUKTI FOTO -->
                        <div class="col-md-6">
                            <h6 class="fw-bold text-dark mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
                                <i class="fa-solid fa-clipboard-check text-warning"></i> Reports & Proof of Results
                            </h6>

                            <!-- CATATAN ADMIN -->
                            <div class="mb-4">
                                <div class="info-label mb-1">Notes from the Admin / Architect Team</div>
                                <div class="p-3 bg-light rounded-3 border">
                                    @if ($consultation->note)
                                        <p class="mb-0 text-dark fw-medium" style="font-size: 0.95rem;">
                                            <i class="fa-solid fa-quote-left me-2 text-warning opacity-50"></i>{{ $consultation->note }}
                                        </p>
                                    @else
                                        <span class="text-muted italic" style="font-size: 0.88rem;">
                                            <i class="fa-regular fa-clock me-1"></i> No notes have been added by the admin yet.
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- BUKTI FOTO KEGIATAN -->
                            <div>
                                <div class="info-label mb-2">View Full Size Photo</div>
                                @if ($consultation->image)
                                    <div class="image-preview-container">
                                        <a href="{{ asset('storage/' . $consultation->image) }}" target="_blank" class="d-block">
                                            <img src="{{ asset('storage/' . $consultation->image) }}"
                                                 alt="Bukti Konsultasi"
                                                 class="w-100"
                                                 style="height: 220px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <a href="{{ asset('storage/' . $consultation->image) }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-expand me-1"></i> View Full Size Photo
                                        </a>
                                    </div>
                                @else
                                    <div class="p-4 bg-light rounded-3 border text-center text-muted">
                                        <i class="fa-regular fa-image fs-2 d-block mb-2 text-secondary opacity-50"></i>
                                        <span style="font-size: 0.88rem;">No proof photos have been uploaded by the team yet.</span>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <!-- FOOTER KARTU -->
                <div class="card-footer bg-light px-4 px-md-5 py-3 d-flex justify-content-between align-items-center text-muted small">
                    <div>
                        <i class="fa-regular fa-calendar-check me-1"></i> Created at:
                        <strong>{{ \Carbon\Carbon::parse($consultation->created_at)->locale('id')->translatedFormat('d F Y, H:i') }} WIB</strong>
                    </div>
                    <div class="fw-semibold text-dark">
                        Nexus Craft
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
