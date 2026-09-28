@extends('back.layout.template')

@section('title', 'Create Article - Nexus Craft')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Article</h1>
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

        <form action="{{ url('article') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                    {{-- Judul Artikel --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                            placeholder="Enter article title...">
                    </div>

                    {{-- Konten Artikel --}}
                    <div class="mb-3">
                        <label for="desc" class="form-label">Descripsition</label>
                        <textarea name="desc" id="myeditor" rows="10"
                            class="form-control @error('desc') is-invalid @enderror"
                            placeholder="Write article content here...">{{ old('desc') }}</textarea>
                    </div>

                <div class="">
                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option value="" hidden>-- Select Category --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-3">
                        <label for="img">Image (Max 2MB)</label>
                        <input type="file" name="img" id="img" class="form-control">

                        <div class="mt-2 text-center">
                            <img src="" alt="" class="img-thumbnail img-preview d-none" width="100px">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" hidden>-- choose --</option>
                                    <option value="1">Publish</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="publish_date">Publish Date</label>
                                <input type="date" name="publish_date" id="publish_date" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url('article') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@push('js')
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
        clipboard_handleImages: false
    }

</script>

<script>
    CKEDITOR.replace( 'myeditor', options);
</script>
<script>
    // Fitur untuk pratinjau gambar sebelum di-upload
    function previewImg() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
            imgPreview.classList.remove('d-none');
        }
    }

</script>
@endpush
