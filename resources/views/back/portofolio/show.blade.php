@extends('back.layout.template')

@section('title', 'Detail Portofolio - Nexus Craft')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Portofolio</h1>
    </div>

    <div class="mt-3">
        <table class="table table-striped table-bordered">
            <tr>
                <th width="250px">Title</th>
                <td>: {{ $portofolio->title }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>: {{ $portofolio->category->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>: {!! $portofolio->desc !!}</td>
            </tr>
            {{-- <tr>
                <th>Image</th>
                <td>
                    <a href="{{ asset('storage/portofolio/'.$portofolio->img) }}" target="_blank" rel="noopener
            noreferrer">
            <img src="{{ asset('storage/portofolio/'.$portofolio->img) }}" alt="" width="50%">
            </a>
            </td>
            </tr> --}}
            <tr>
                <th>Gambar Utama & Galeri</th>
                <td>
                    <div class="d-flex flex-wrap gap-2">
                        <!-- Gambar Utama / Cover -->
                        @if($portofolio->img)
                        <a href="{{ asset('storage/portofolio/'.$portofolio->img) }}" target="_blank"
                            rel="noopener noreferrer">
                            <img src="{{ asset('storage/portofolio/'.$portofolio->img) }}" alt="Cover Utama"
                                class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;"
                                title="Cover Utama">
                        </a>
                        @endif

                        <!-- Foto Galeri Tambahan -->
                        @if($portofolio->images)
                        @foreach($portofolio->images as $item)
                        <a href="{{ asset('storage/portofolio/' . $item->image_path) }}" target="_blank"
                            rel="noopener noreferrer">
                            <img src="{{ asset('storage/portofolio/' . $item->image_path) }}" alt="Galeri Tambahan"
                                class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;"
                                title="Galeri Tambahan">
                        </a>
                        @endforeach
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <th>Client</th>
                <td>: {{ $portofolio->client }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>:
                    @if ($portofolio->status == 'published' || $portofolio->status == 1)
                    <span class="badge bg-success">Published</span>
                    @else
                    <span class="badge bg-danger">Draft</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Publish Date</th>
                    <td>{{ \Carbon\Carbon::parse($portofolio->publish_date)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->translatedFormat('d M Y') }}</td>
            </tr>
            {{-- <tr>
                <th>Writer</th>
                <td>: {{ $portofolio->user?->name ?? 'Admin' }}</td>
            </tr> --}}
        </table>

        <div class="float-end mt-2">
            <a href="{{ route('portofolio.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</main>
@endsection
