@extends('back.layout.template')

@section('title', 'Update Portofolio - Nexus Craft')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Portofolio</h1>
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

        <form action="{{ url('portofolio/'.$portofolio->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <input type="hidden" name="oldImg" value="{{ $portofolio->img }}">

            <div class="row">
                {{-- Judul Artikel --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $portofolio->title) }}" placeholder="Masukkan judul artikel...">
                </div>

                {{-- Konten Artikel --}}
                <div class="mb-3">
                    <label for="desc" class="form-label">Descripsition</label>
                    <textarea name="desc" id="myeditor" rows="10"
                        class="form-control @error('desc') is-invalid @enderror"
                        placeholder="Tulis isi artikel di sini...">{{ old('desc', $portofolio->desc) }}</textarea>
                </div>

                <div class="">
                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                            @if ($category->id == $portofolio->category_id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        {{-- Upload Gambar --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="img">Images / Gallery (Will replace all existing photos if filled)</label>
                                <!-- Tambahkan name="img[]" dan atribut multiple -->
                                <input type="file" name="img[]" id="img" class="form-control" multiple accept="image/*"
                                    onchange="previewImg()">

                                <!-- Preview Foto Baru -->
                                <div class="mt-2 d-flex flex-wrap gap-2" id="preview-container"></div>

                                <!-- Daftar Foto Lama -->
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Current Existing Photos:</small>
                                    <div class="d-flex flex-wrap gap-2">
                                        <!-- Foto Cover Utama -->
                                        @if($portofolio->img)
                                        <img src="{{ asset('storage/portofolio/'.$portofolio->img) }}"
                                            class="img-thumbnail" style="width: 70px; height: 70px; object-fit: cover;"
                                            title="Cover Utama">
                                        @endif

                                        <!-- Foto Galeri Tambahan -->
                                        @if($portofolio->images)
                                        @foreach($portofolio->images as $item)
                                        <img src="{{ asset('storage/portofolio/' . $item->image_path) }}"
                                            class="img-thumbnail" style="width: 70px; height: 70px; object-fit: cover;"
                                            title="Galeri">
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="client">Client</label>
                                <input type="text" name="client" id="client" class="form-control"
                                    value="{{ old('client', $portofolio->client) }}">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $portofolio->status == 1 ? 'selected' : '' }}>Publish</option>
                                <option value="0" {{ $portofolio->status == 0 ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="publish_date">Publish Date</label>
                            <input type="date" name="publish_date" id="publish_date" class="form-control"
                                value="{{ old('publish_date', $portofolio->publish_date) }}">
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ url('portofolio') }}" class="btn btn-secondary">Back</a>
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
    CKEDITOR.replace('myeditor', options);

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
