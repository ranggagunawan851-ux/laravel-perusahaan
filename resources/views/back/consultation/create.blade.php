@extends('back.layout.template')

@section('title', 'Create Consultation - Nexus Craft')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Consultation</h1>
    </div>

    <div class="mt-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('consultation') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="contoh@email.com">
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                    </div>

                    {{-- Service / Service --}}
                    <div class="mb-3">
                        <label for="service_id" class="form-label">Service</label>
                        <select name="service_id" id="service_id"
                            class="form-select @error('service_id') is-invalid @enderror">
                            <option value="" hidden>-- Select Service --</option>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->nama_service }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="" hidden>-- Select Status --</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processed" {{ old('status') == 'processed' ? 'selected' : '' }}>Processed</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    {{-- Message / Pesan Konsultasi --}}
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" rows="4"
                            class="form-control @error('message') is-invalid @enderror"
                            placeholder="Masukkan detail pesan atau pertanyaan konsultasi">{{ old('message') }}</textarea>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url('consultation') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
