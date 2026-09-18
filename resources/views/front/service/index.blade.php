@forelse ($services as $index => $item)
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}" data-aos-duration="800">
        <div class="card h-100 shadow-sm border-0 text-center p-3">
            <div class="card-body d-flex flex-column">

                {{-- Gambar / Ikon (Diubah ke slug) --}}
                <a href="{{ route('front.service.show', $item->slug) }}" class="text-decoration-none">
                    @if ($item->img)
                        <div class="mb-3 mx-auto" style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%;">
                            <img src="{{ asset('storage/service/' . $item->img) }}" alt="{{ $item->nama_service }}" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                    @else
                        <div class="feature-icon bg-primary bg-gradient text-white mb-3 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-laptop fs-3"></i>
                        </div>
                    @endif
                </a>

                {{-- Judul Service (Diubah ke slug) --}}
                <h5 class="card-title fw-bold">
                    <a href="{{ route('front.service.show', $item->slug) }}" class="text-dark text-decoration-none">
                        {{ $item->nama_service }}
                    </a>
                </h5>

                {{-- Format Harga --}}
                <p class="text-primary fw-bold mb-2">
                    Rp {{ number_format((float) $item->price, 0, ',', '.') }}
                </p>

                <p class="card-text text-muted small flex-grow-1">
                    {{ Str::limit(strip_tags($item->desc), 100, '...') }}
                </p>

                {{-- Tombol View Detail & Consultation --}}
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('front.service.show', $item->slug) }}" class="btn btn-outline-secondary btn-sm flex-fill">
                        View Detail
                    </a>
                    <a href="#consultation" onclick="selectService('{{ $item->id }}')" class="btn btn-outline-primary btn-sm flex-fill">
                        Consultation
                    </a>
                </div>

            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center text-muted" data-aos="fade-up">
        <p>No services available yet.</p>
    </div>
@endforelse
