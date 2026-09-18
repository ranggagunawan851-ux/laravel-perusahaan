@extends('back.layout.template')

@section('title', 'Detail Service - Nexus Craft')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Service</h1>
    </div>

    <div class="mt-3">
        <table class="table table-striped table-bordered">
            <tr>
                <th width="250px">Nama Service</th>
                <td>: {{ $service->nama_service }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>: {{ $service->category->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>: {!! $service->desc !!}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    <a href="{{ asset('storage/service/'.$service->img) }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('storage/service/'.$service->img) }}" alt="" width="50%">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Price</th>
                <td>: Rp. {{ number_format((float) ($service->price ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Publish Date</th>
                    <td>{{ \Carbon\Carbon::parse($service->publish_date)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->translatedFormat('d-m-Y') }}</td>
            </tr>
            {{-- <tr>
                <th>Writer</th>
                <td>: {{ $service->user?->name ?? 'Admin' }}</td>
            </tr> --}}
        </table>

        <div class="float-end mt-2">
            <a href="{{ route('service.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</main>
@endsection
