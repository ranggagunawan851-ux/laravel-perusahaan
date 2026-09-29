@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.min.css">
@endpush

@section('title', 'Portofolio Perusahaan - Nexus Craft')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-regular fa-file-lines"></i> Portofolios </h1>
    </div>

    <div class="mt-3">
        <a href="{{ url('portofolio/create')}}" class="btn btn-success mb-2"><i class="fa-solid fa-plus"></i> Create</a>

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
                    <th>Category</th>
                    <th>Client</th>
                    <th>Status</th>
                    {{-- <th>Publish Date</th> --}}
                    <th>Function</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($portofolios as $item)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->title}}</td>
                    <td>{{ $item->category->name}}</td>
                    <td>{{ $item->client}}</td>

                    @if ($item->status == 0)
                        <td>
                            <span class="badge bg-danger">Draft</span>
                        </td>
                    @else
                        <td>
                            <span class="badge bg-success">Publish</span>
                        </td>
                    @endif

                    {{-- <td>{{ $item->publish_date}}</td> --}}

                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-1">
                            <a href="{{ route('portofolio.show', $item->id) }}" class="btn btn-secondary">Detail</a>
                            <a href="{{ route('portofolio.edit', $item->id) }}" class="btn btn-primary">Edit</a>

                            <a href="javascript:void(0)"
                            onclick="deletePortofolio(this)"
                            data-id="{{ $item->id }}"
                            class="btn btn-danger">Delete</a>

                            <form id="delete-form-{{ $item->id }}"
                                action="{{ route('portofolio.destroy', $item->id) }}"
                                method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
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
            'timer' : 2000
        })
    }

    function deletePortofolio(e) {
    let id = e.getAttribute('data-id');

    Swal.fire({
        title: 'Delete Portofolio',
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
                url: '/portofolio/' + id,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                    }).then(() => {
                        window.location.href = '/portofolio';
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
