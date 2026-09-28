@extends('back.layout.template')

@section('title', 'Detail Article - Nexus Craft')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Article</h1>
    </div>

    <div class="mt-3">
        <table class="table table-striped table-bordered">
            <tr>
                <th width="250px">Title</th>
                <td>: {{ $article->title }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>: {{ $article->category->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>: {!! $article->desc !!}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    <a href="{{ asset('storage/back/'.$article->img) }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('storage/back/'.$article->img) }}" alt="" width="50%">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Views</th>
                <td>: {{ $article->views ?? 0 }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>:
                    @if ($article->status == 'published' || $article->status == 1)
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-danger">Draft</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Publish Date</th>
                    <td>{{ \Carbon\Carbon::parse($article->publish_date)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->translatedFormat('d M Y') }}</td>
            </tr>
        </table>

        <div class="float-end mt-2">
            <a href="{{ route('article.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</main>
@endsection
