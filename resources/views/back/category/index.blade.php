@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.min.css">
@endpush

@section('title', 'Category Perusahaan - Nexus Craft')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-regular fa-file-lines"></i> Categories</h1>
    </div>

    <div class="mt-3">
        <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate"><i class="fa-solid fa-plus"></i> Create</button>

        @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="swal" data-swal="{{ session('success')}}"></div>

        <table class="table table-striped table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    <th>Function</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $item)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->name}}</td>
                    <td>{{ $item->slug}}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-1">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $item->id }}">Edit</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- modal create --}}
    @include('back.category.create-modal')

    {{-- modal update --}}
    @include('back.category.update-modal')

    {{-- modal delete --}}
    @include('back.category.delete-modal')

</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const swal = $('.swal').data('swal');
    if (swal) {
        Swal.fire({
            'title': 'Success',
            'text': swal,
            'icon': 'success',
            'showConfirmButton': false,
            'timer': 2000
        })
    }

    function deleteCategories(e) {
        let id = e.getAttribute('data-id');

        Swal.fire({
            title: 'Delete Categories',
            text: "Are You Sure.?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: '/categories/' + id,
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                        }).then(() => {
                            window.location.href = '/categories';
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

</script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable()
    });

</script>
@endpush
